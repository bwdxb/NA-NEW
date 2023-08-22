<?php

namespace App\Http\Controllers\CareerPortal;

use App\Http\Controllers\Controller;
use App\JobVacancy;
use App\Subscriptions;
use App\ServiceCMS;
use Carbon\Carbon;
use App\Http\Controllers\Traits\MailTrait;
use GuzzleHttp\Client;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Session;


class SubscriptionController extends Controller
{
    use MailTrait;
    public function addSubscriber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            // 'email' => 'required|unique:subscriptions,email',
            'job_category' => 'required',
            'g-recaptcha-response' => 'required',
            
        ]);
        
        
        
        if ($validator->fails()) {
            foreach ($validator->messages()->get('*') as $key => $value) {
               
                Session::flash('error', $value[0]);
            }
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
            $isExist= Subscriptions::where('email',$request->email)->first();
            if($isExist){
                if($isExist->status=='ACTIVE'){
                    $isExist->job_category=implode(',',$request->job_category);
                    $isExist->save();
                    Session::flash('subscription_success', __('Subscription successful '));
                    Session::flash('success', __('You are already subcribed and we have updated the subcribed job alert category.'));
                    Session::flash('title_msg', __('Job Alert Subscription'));
                    // $this->subscriptionMail($request->all()+['name'=>$request->email]);
                }else{
                    $isExist->job_category=implode(',',$request->job_category);
                    $isExist->save();
                    Session::flash('subscription_success', __('Subscription not verified yet !'));
                    Session::flash('success', __('You have not confirmed your subscription yet. Please check your inbox for the confirmation email in order to complete your subscription.'));
                    Session::flash('title_msg', __('Subscription not verified yet !'));
                    $this->subscriptionMail(['name'=>$request->email,'email'=>$request->email]);
                }
                return redirect()->back();
            }else{
                $subcriptionData = Subscriptions::create(["email"=>$request->email,"job_category"=>implode(',',$request->job_category)]);
            }
            
            // dd($subcriptionData);
            if (!$subcriptionData) {
                Session::flash('error', __('Failed to subscribe'));
                return redirect()->back()->withInput();
            }

            Session::flash('subscription_success', __('Subscription successful '));
            Session::flash('success', __('Thank you for subscribing to our job alerts. Please check your inbox for the confirmation email in order to complete your subscription.'));
            Session::flash('title_msg', __('Job Alert Subscription'));
            $this->subscriptionMail($request->all()+['name'=>$request->email]);
            return redirect()->back();

        } catch (\Exception $ex) {
           Log::error($e);
            Session::flash('error', __('internal server error'));
            return redirect()->back()->withInput();
        }
    }

    public function verifySubscription(Request $request)
    {
       
        try {
        $SECRET_STRING = "S3cr3t@123";
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'hash_key' => 'required',
           
        ]);
        
            $email = $request->email;
            $hash_key = $request->hash_key;
            $expected = md5( $email . $SECRET_STRING );
            if( $hash_key != $expected ) {
                Session::flash('error', __('invalid url'));
                return "<h1>Invalid url</h1>";
                // return redirect()->back();
            }
            

     
            $subData = Subscriptions::where('email',$email)->first();

            if($subData){
                if ($subData->status=='ACTIVE') {

                    // Session::flash('error', __('You have alredy verified'));
                    return view('website.subscription.already_subscribed');
                }else{
                    $subData->status="ACTIVE";
                    $subData->save();
                    // Session::flash('success', __('subscription successful'));
                    return view('website.subscription.subscription');

                }
            }else{
                return "<h1>Invalid url</h1>";
            }

        } catch (\Exception $ex) {
           Log::error($ex);
            Session::flash('error', __('internal server error'));
            return "<h1>Internal server error</h1>";
        }
    }

    public function unsubscribe(Request $request)
    {
        
        $SECRET_STRING = "S3cr3t@123";
        try {

            $email = $request->email;
            $hash_key = $request->hash_key;
            $expected = md5( $email . $SECRET_STRING );
            if( $hash_key != $expected ) {
                Session::flash('error', 'invalid url');
                return redirect()->back();
            }
            
            $subData = Subscriptions::where('email',$email)->first();

            if (!$subData) {
                // Session::flash('error', __('already unsubscribed'));
                return view('website.subscription.already_unsubscribed');
            }else{
                $subData->delete();
                // Session::flash('success', __('Unsubscription successful'));
                return view('website.subscription.unsubscribed');
            }

        } catch (\Exception $ex) {
            Session::flash('error', __('internal server error'));
            return "<h1>internal server error</h1>";
        }
    }

    


}