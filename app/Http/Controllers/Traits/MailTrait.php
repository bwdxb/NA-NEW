<?php

namespace App\Http\Controllers\Traits;

use App\JobVacancy;
use App\JobVacancyCategory;
use App\Subscriptions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait MailTrait
{
    private function marketplace($user_data,$iuser,$product_name)
    {
        $to_name = $user_data->first_name." ".$user_data->last_name;
        $to_email = $user_data['email'];
        //        Log::error('mail data : ' . json_encode($user_data));
        Mail::send('emails.market_place_interest', ['iuser'=>$iuser->first_name." ".$iuser->last_name,'product_name'=>$product_name,'name'=>$user_data->first_name." ".$user_data->last_name], function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
            ->subject(__('Your have a new interest recieved on Market Place Product'));
     });
    }
    private function story($user_data,$iuser,$product_name="")
    {
        $to_name = $user_data->first_name." ".$user_data->last_name;
        $to_email = $user_data['email'];
        //        Log::error('mail data : ' . json_encode($user_data));
        Mail::send('emails.market_place_interest', ['iuser'=>$iuser->first_name." ".$iuser->last_name,'product_name'=>$product_name,'name'=>$user_data->first_name." ".$user_data->last_name], function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
            ->subject(__('Your story has been approved'));
        });
    }
    private function uat_admin_mail($user_data)
    {
        //        Log::error('mail data : ' . json_encode($user_data));
        Mail::send('bakk.uat_admin_mail', $user_data, function ($message) use ($user_data) {
            $message->to('info@uatfresh.com', config('app.name').' Administrator')
                ->subject(config('app.name').' Order Alert !!!')
                ->from(config('mail.username'), config('app.name').' DEV Team');
        });
    }

    private function pcr($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.pcr', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('Your feedback has been received'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function user_mail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];
            $subject=__('Your feedback has been received');
            switch ($data['type']) {
                case "Request Patient Care Record (PCR)":
                    $subject=__('Your request has been received');
                    break;
                case "Suggestion":
                    $subject=__('Your message has been received');
                    break;
                case "Other":
                    $subject=__('Your message has been received');
                    break;
                default:
                    $subject=__('Your feedback has been received');
                    break;
            }



            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/
            // 
            Mail::send('emails.feedback', $data, function ($message) use ($to_name, $to_email,$subject) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject($subject);
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function user_pts_mail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.feedback', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('National Ambulance Feedback Mail'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }
    private function pts_mail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.pts', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('Non-Emergency Patient Transport Request'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }
    private function supplier_mail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.supplier', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('Supplier Registration Request'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }
    private function events_mail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.events', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('Event Emergency Medical Coverage Request'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function generalVacancyMail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.general_cv', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('CV Receipt Confirmation'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function jobApplicationMail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];
            $vacancy = JobVacancy::where('job_id', $data['job_id'])->first();
            $data['job_title'] = $vacancy->job_title;
            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/
            // $jobCatData =JobVacancyCategory::where('job_category',$vacancy->job_category)->first();

            // $subscribers = Subscriptions::whereIn('job_category',explode(',',$vacancy->job_category))->where('status', 'ACTIVE')->get()->pluck('email')->toArray();
            // $subscribers = Subscriptions::where([['job_category', '=', $vacancy->job_category], ['status', '=', 'ACTIVE']])->orWhere([['job_category', '=', 'all'], ['status', '=', 'ACTIVE']])->get()->pluck('email')->toArray();
            // $subscribers = Subscriptions::whereIn('job_category',explode(',',$vacancy->job_category))->where('status', 'ACTIVE')->get()->pluck('email')->toArray();
            $searchWords = explode(',',$vacancy->job_category);
            $subscribers = Subscriptions::where('status',"ACTIVE");
            foreach($searchWords as $word){
                $subscribers->orWhere('job_category', 'LIKE', '%'.$word.'%');
            }
            $subscribers = $subscribers->distinct('email')->get()->pluck('email')->toArray();
            // dd('Request Id '.$data['reference_no'].' Job Application '.$data['job-desc'].' has been assigned to you.');
            Mail::send('emails.job_application', $data, function ($message) use ($to_name, $to_email,$data) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    // ->subject(("Request Id ".$data["reference_no"]." Job Application ".$data["job-desc"]." has been assigned to you."));
                    ->subject((__('Your application for ')).$data['job_title'].(__(' position.')));
            });
            // dd($data);
            foreach ($subscribers as $key => $value) {
                // $this->jobAlertMail(['email' => $value, 'name' => $value, 'vacancy' => $vacancy]);
            }
        } catch (\Exception $exc) {
            // dd($exc);
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));
            // dd($exc);
            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function subscriptionMail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.subscription', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('Please confirm your subscription to National Ambulances job alerts'));
            });
        } catch (\Exception $exc) {
            Log::error($exc);

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function jobAlertMail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.job_alert_to_subcribers', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('National Ambulance New Job Alert'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));

            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function education_mail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.education', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject(__('RE: EMS Educational Training Request'));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));
            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

    private function course_apply_mail($data)
    {
        $status = true;
        try {
            $to_name = $data['name'];
            $to_email = $data['email'];

            /*        Log::error('mail data : '.json_encode([
                        'to name' => $to_name,
                        'to email' => $to_email,
                        'mail data' => $data,
                      ));
            **/

            Mail::send('emails.course_apply', $data, function ($message) use ($to_name, $to_email,$data) {
                $message->to($to_email, $to_name)
                    ->from(env('MAIL_FROM','noreply@nationalambulance.ae'), __('National Ambulance'))
                    ->subject((__('RE: Educational Course Booking Request')));
            });
        } catch (\Exception $exc) {
            Log::error('exception message : '.$exc->getMessage());
            Log::error('exception in : '.$exc->getFile());
            Log::error('exception line no. : '.$exc->getLine());
            Log::error('exception trace : '.json_encode($exc->getTrace()));
            $status = false;
        }

        if ($status) {
            return 'Mail send successfull';
        }

        return 'Failed to send Mail';
    }

}
