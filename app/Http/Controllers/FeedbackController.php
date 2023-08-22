<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Traits\RequestManageEngineTrait;
use App\Http\Controllers\Traits\SmsTrait;
use App\Http\Controllers\Traits\UtilTrait;

use App\ServiceCMS;
use App\ServiceCMSVersion;
use App\StaticContent;
use Auth;
use Carbon\Carbon;
use DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;
use Mail;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Butschster\Head\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;



class FeedbackController extends Controller
{
    use RequestManageEngineTrait;
    use MailTrait;
    use SmsTrait;
    use UtilTrait;

    public function index(Request $request)
    {
        $data = ServiceCMS::find(2);
        $page = StaticContent::where('slug', 'feedback')->first();
        if($page){
            $title= app()->getLocale() != 'en'?$page->title_ar:$page->title;
            $image= url('public/uploads/feedback/'.$data->banner);
            $description= app()->getLocale() != 'en'?$page->description_ar:$page->description;
            $og = new OpenGraphPackage($title);
            $og->addImage($image);
            $og->setTitle($title);

            $og->setDescription(substr(strip_tags($description),0,300).'...');
            $card = new TwitterCardPackage($title);
            $card->setTitle($title);
            $card->setDescription(substr(strip_tags($description),0,300).'...');
            $card->setImage($image);
            
            $card->setType('summary_large_image');
                Meta::registerPackage($card);
            Meta::registerPackage($og);
            Meta::prependTitle($title);
        }
//        return view('website.feedback', compact('page'));
        return view('website.feedback', [
            'data' => $data,
            'page' => $page,
        ]);
    }

    public function postFeedback(Request $request)
    {
        $now = Carbon::now();
        $type = [
            'Complaint',
            'Compliment',
            'Suggestion',
            'Request Patient Care Record (PCR)',
            'Other',
        ];

        $emirates = [
            'Sharjah',
            'Ajman',
            'Umm Al Quwain',
            'Ras Al Khaimah',
            'Fujairah',
            'Abu Dhabi',
            'Dubai',
        ];

        $validator = Validator::make($request->all(), [
            'type' => 'required|in:' . implode(',', $type),
            'title' => 'required',
            'name' => 'required',
            'nationality' => 'required_if:type,==,Complaint,Compliment',
            'emirate_or_passport_files' => 'sometimes|nullable|required_if:type,==,Request Patient Care Record (PCR)',
            'email' => 'required|email',
            'contact' => 'required',
            'cad' => 'sometimes',
            'incident_date' => 'sometimes',
            'area_location' => 'required_if:type,==,Complaint,Compliment',
            'emirates' => 'required',
            'feedback_message' => 'required',
            'solution' => 'sometimes',
            'agreement' => 'required',
            'g-recaptcha-response' => 'required',
        ],['required'=>'this field is required']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $client = new Client;
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => config('services.recaptcha.secret'),
                        'response' => $request['g-recaptcha-response'],
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        if (!$body || !$body->success) {
            $validator->errors()->add(
                'g-recaptcha-response', 'Invalid captcha code.'
            );
            Session::flash('error',"Invalid captcha");
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        $today_count = Feedback::where('type', $request->type)->get()->count();
        $format_index = sprintf("%02d", ($today_count + 1));
        $today = Carbon::now()->format('Ymd');
        $complaint_format = '';
        $data = $request->all();
        // if ($request->type === 'Complaint') {
        // code...

        switch ($request->type) {
            case 'Complaint':
                $complaint_format = "WNA-CMP-" . $today . "-" . $format_index;
                break;
            case 'Compliment':
                $complaint_format = "WNA-COM-" . $today . "-" . $format_index;
                break;
            case 'Suggestion':
                $complaint_format = "WNA-SUG-" . $today . "-" . $format_index;
                break;
            case 'Request Patient Care Record (PCR)':
                $complaint_format = "WNA-PCR-" . $today . "-" . $format_index;
                break;
            default :
                $complaint_format = "WNA-OTH-" . $today . "-" . $format_index;
                break;
        }
        
        $data['reference_number'] = $complaint_format;
        // }

        $feedback = Feedback::create($request->all() +
            [
                'feedback_ref' => $complaint_format,
            ]
        );

        if (!$feedback) {
            return back()->with('error', 'feedback save failed')->withInput();
        }
        $unique_timestamp = $now->format('YmdHisu');
        if (!empty($request->file('emirate_or_passport_files'))) {
            $medicalReportFileUrlArr=[];
            $medicalReportFiles = $request->file('emirate_or_passport_files');
            
            foreach ($medicalReportFiles as $key=>$medicalReportFile) {
                $medicalReportFilename = 'Document-'.($key+1 ). '-' . $unique_timestamp . '.' . $medicalReportFile->getClientOriginalExtension();
                 $medicalReportFile->move(public_path('uploads/PCR'), $medicalReportFilename);
                //$logoUrl=$this->s3Upload('uploads/PCR',$medicalReportFilename,$medicalReportFile);

                if(in_array($medicalReportFile->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){
                //$medicalReportFileUrl = '<a href=\''.route('download').'?u='.$logoUrl.'\'>File-'.($key+1).'</a>';
                 $medicalReportFileUrl = '<a href=\''.route('download').'?u='.url(('/public/uploads/PCR/' . $medicalReportFilename)).'\'>File-'.($key+1).'</a>';
            }else{

                //$medicalReportFileUrl = '<a href=\''.$logoUrl.'\'>File-'.($key+1).'</a>';
                 $medicalReportFileUrl = '<a href=\''.url(('/public/uploads/PCR/' . $medicalReportFilename)).'\'>File-'.($key+1).'</a>';
            }
                
                $medicalReportFileUrlArr[] = $medicalReportFileUrl;
            }
            $data['emirate_or_passport_files']=implode(", ", $medicalReportFileUrlArr);
        }else{
            unset($data['emirate_or_passport_files']);
        }
        
        unset($data['_token']);
        unset($data['title']);
        unset($data['g-recaptcha-response']);
        
       

        $this->feedbackRequestManageEngine($data);

        $msg_complaint = __("Thank you for bringing this matter to our attention.  We will review your message and shall be in touch with you in due course.").'\n '.__('Reference').' #:  \n' . $complaint_format;
        $msg_compliment = __("Thank you for taking time to share your positive feedback with us. We will pass on your message(s) to our respective teams. Thank you!.");
        $msg_suggestion = __("Thank you for sharing your suggestion(s) with us. It will be passed on to the relevant team(s) for consideration for improving our services.") .'\n '.__('Reference').' #: \n ' .$complaint_format;
        $msg_pcr = __("We will contact you to verify the information provided in the form before we proceed with your request.") .'\n '.__('Reference').' #: \n ' .$complaint_format;
        $msg_other = __("Thank you for sharing your feedback with us. It will be passed on to the relevant team(s) for consideration or further action if required.") .'\n '.__('Reference').' #:  \n' .$complaint_format;

        $messenger_data = '';
        switch ($request->type) {
            case 'Complaint':
                $messenger_data = $msg_complaint;
                $english_text='Thank you for bringing this matter to our attention.Your reference number: '.$complaint_format.'. We value your feedback. National Ambulance';
                $arabic_text="شكرا لتواصلكم مع الإسعاف الوطني
                رقم ملاحظتكم:
               ".$complaint_format."
                ملاحظاتكم تهمنا";
                $smsContent = (app()->getLocale() == 'en')?($english_text):($arabic_text);
                // $smsContent = 'Thank you for bringing this matter to our attention. \n\n
                // Your reference number: '.$complaint_format.'\n\n
                // We value your feedback \n\n
                // National Ambulance';
                $messenger_status = $this->feedback_messenger($data['contact'],$smsContent);// send sms for complaint only
                Log::info("SMS SEND : ".$data['contact']);
                Log::info("Message Content : \r\n".$smsContent);
                Log::info($messenger_status);
                break;
            case 'Compliment':
                $messenger_data = $msg_compliment;
                break;
            case 'Suggestion':
                $messenger_data = $msg_suggestion;
                unset($data['incident_date']);
                unset($data['cad']);
                unset($data['nationality']);
                unset($data['area_location']);
                break;
            case 'Request Patient Care Record (PCR)':
                $messenger_data = $msg_pcr;
               
                break;
            default :
                $messenger_data = $msg_other;
                unset($data['incident_date']);
                unset($data['cad']);
                unset($data['nationality']);
                unset($data['area_location']);

        }
        $data['msg'] = $messenger_data;
        $data['reference_no'] = $complaint_format;
        $data['type'] = $request->type;
        $data['name'] = $request->name;
        $mail_status = $this->user_mail($data);

        if($data['type']=="Request Patient Care Record (PCR)"){
            Session::flash('success', $messenger_data);
            Session::flash('title_msg', __("Thank you for your request"));
        }else{
              Session::flash('success', $messenger_data);
               Session::flash('title_msg', __("We value your feedback"));
        }
             

        return redirect('/feedback#feedback-form')
            ->with('msg', $messenger_data);
    }

    public function adminCMSManageFeedbackInfo()
    {
        try {
            $feedback = ServiceCMS::find(2);

            // Session::flash('success', 'Feedback CMS Components loaded successfully');

            return view('Admins.static_management.manage_feedback_info', [
                'data' => $feedback,
            ]);
        } catch (\Exception $ex) {
            // dd([
            //     'exception message'=>$ex->getMessage(),
            //     // 'exception in'=>$ex->getFile(),
            //     'exception line no.'=>$ex->getLine(),
            //     // 'exception trace'=>$ex->getTrace(),
            // ]);
            Session::flash('error', __('internal server error'));
            // return back()->with('error', 'Internal Server Error Occured, Please try again later...');
            return back();
        }
    }

    public function adminUpdateCMSManageFeedbackInfo(Request $request)
    {
        try {
            $oldPage = ServiceCMS::find(2);
            $serviceCMS = ServiceCMS::find(2);

            $serviceCMS->title = $request->title;
            $serviceCMS->title_ar = $request->title_ar;
            $serviceCMS->intro = $request->intro;
            $serviceCMS->intro_ar = $request->intro_ar;
            $serviceCMS->concl = $request->concl;
            $serviceCMS->concl_ar = $request->concl_ar;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/feedback'), $new_name);
                $serviceCMS->banner = $new_name;
            }
            if($request->preview){
                // dd($request->all());
                $page = StaticContent::where('slug', 'feedback')->first();            
                $html =  view('website.feedback', [
                    'data' => $serviceCMS,
                    'page' => $page,
                ])->render();
                 return redirect()->back()->with("preview_page",$html)->withInput();
                }else{
                    if($serviceCMS->isDirty()){
                        if ($serviceCMS->save()) {
                            $tempPageData= $oldPage->toArray();
                            $tempPageData['cms_id']=$tempPageData['id'];
                            $tempPageData['created_by']=Auth::user()->id;
                            unset($tempPageData['id']);
                            unset($tempPageData['created_at']);
                            $vcData= new ServiceCMSVersion($tempPageData);
                            $vcData->save();
                            // dd($vcData);
                            Session::flash('success', __('Feedback Info has been updated successfully'));

            } else {
                Session::flash('error', __('Failed to update feedback info'));
            }
            }else{
                $serviceCMS->refresh();
                return view('Admins.static_management.manage_feedback_info', [
                    'data' => $serviceCMS,
                ]); 
            }
        }
        } catch (\Exception $ex) {
            // dd($ex);
            Log::error($ex);

            Session::flash('error', __('internal server error'));
           
        }
        // return redirect()->route('cms.manage_service');
        $serviceCMS->refresh();

        return view('Admins.static_management.manage_feedback_info', [
            'data' => $serviceCMS,
        ]);
    }

    
    public function pageRevert(Request $request,$id)
	{
        try{
            $revertPageData =  ServiceCMSVersion::where('id',$id)->first();
            $oldPage = ServiceCMS::find($revertPageData->cms_id);
            $page = ServiceCMS::find($revertPageData->cms_id);
            $page->intro = $revertPageData->intro;
            $page->intro_ar = $revertPageData->intro_ar;
            $page->concl = $revertPageData->concl;
            $page->concl_ar = $revertPageData->concl_ar;
            $page->banner = $revertPageData->banner;
           if($request->preview){
            $staticContentData = StaticContent::where('slug', 'feedback')->first();            
                $html =  view('website.feedback', [
                    'data' => $page,
                    'page' => $staticContentData,
                ])->render();
                 return redirect()->back()->with("preview_page",$html)->withInput();
                }else{ 
               if($page->isDirty()){
                if($page->save())
                {
                    $tempPageData= $oldPage->toArray();
                    $tempPageData['cms_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    $vcData= new ServiceCMSVersion($tempPageData+['reverted'=>1]);
                    $vcData->save();                
                    Session::flash('success', 'Page has been reverted successfully');
                }else{
                    Session::flash('error', 'Page not updated successfully');
                }
            }else{
                Session::flash('success', 'Ignored, No changes found in the reverted and current data');
            }
        }
           
        }catch(Exception $ex){
            Log::error($ex);
            Session::flash('error', 'internal server error');
        }
        return redirect('/admin/manage-feedback-info');

    }

    public function history($id)
    {
        try {
            //code...
            $pages = ServiceCMSVersion::where('cms_id',$id)->orderBy('id','DESC');
            $pages = $pages->paginate(10);
            return view('Admins.static_management.our_feedback_history',compact('pages'))->with('i',1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect('/admin/manage-feedback-info');
        }
        
    }
}