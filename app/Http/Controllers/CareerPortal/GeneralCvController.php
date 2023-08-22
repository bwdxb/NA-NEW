<?php

namespace App\Http\Controllers\CareerPortal;

use App\Http\Controllers\Controller;
use App\JobVacancy;
use App\GeneralCv;
use App\ServiceCMS;
use Carbon\Carbon;
use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Traits\UtilTrait;
use App\Http\Controllers\Traits\RequestManageEngineTrait;
use GuzzleHttp\Client;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Session;


class GeneralCvController extends Controller
{
    use UtilTrait;
    use MailTrait;
    use RequestManageEngineTrait;

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'nationality' => 'required',
            'email' => 'required|email',
            'attach_cv' => 'required',
            'g-recaptcha-response' => 'required',
        ]);
        

        if ($validator->fails()) {
            Session::flash('error', __('Please check the fields'));
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $request['g-recaptcha-response'],
                ],
            ]
        );
        $body = json_decode((string) $response->getBody());
        // dd($body);

        if (!$body || !$body->success) {
            // request()->validate(['g-recaptcha-response' => 'Invalid captcha code.']);
            $validator->errors()->add(
                'g-recaptcha-response', 'Invalid captcha code.'
            );
            Session::flash('error',"Invalid captcha");
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        try {
     // dd($request->all());          
            $logoUrl = '';
            if (!empty($request->file('attach_cv'))) {
                $logo = $request->file('attach_cv');
                $logoName = rand(1000, 9999) . '.' . $logo->getClientOriginalExtension();                
                 $temp = $logo->move(public_path('/uploads/vacancy/general/' ), $logoName);
                //$logoUrl=$this->s3Upload('uploads/vacancy/general',$logoName,$logo);
                // dd($logoUrl);
                if(in_array($logo->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                     $logoUrl = '<a  href=\'' .route('download').'?u='.url('/public/uploads/vacancy/general/' . $logoName).'\' download>CV Link</a>';
                    //$logoUrl = '<a  href=\'' .route('download').'?u='.$logoUrl.'\' download>CV Link</a>';
                }else{
                     $logoUrl = '<a  href=\'' .url('/public/uploads/vacancy/general/' . $logoName).'\' download>CV Link</a>';
                    //$logoUrl = '<a  href=\'' .$logoUrl.'\' download>CV Link</a>';

                }

                // if($logoUrl){

                //     dd($this->s3Upload('uploads/vacancy/general/',$logoName,$logo));
                //     $logoUrl=$this->s3Upload('uploads/vacancy/general/',$logoName,$logo);
                // }
            }
        
            
            $data = $request->all();

            unset($data['g-recaptcha-response']);

            $data['cv_file']=$logoUrl;
            $data['name']= $data['title']." ".$data['name'];
            unset($data['title']);
            unset($data['_token']);
            unset($data['attach_cv']);
            
            Session::flash('success', __('We will keep it in our database and if any vacancies arise that match your profile, we will contact you to discuss the opportunity further.'));
            Session::flash('title_msg', __('Thank you for sharing your CV with National Ambulance'));
            $this->generalVacancyRequestManageEngine($data);
            $data['name']= $request->name;
            $this->generalVacancyMail($data);
           
            return redirect()->back();

        } catch (\Exception $ex) {
            Log::error($ex);
            dd($ex);
            Session::flash('error', __('internal server error'));
            return redirect()->back()->withInput();
        }
    }

}