<?php


namespace App\Http\Controllers\Traits;

use App\Http\classes\paytabs;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Storage;

trait UtilTrait
{
    private function validateGCaptcha($captchaResponse)
    {
        $client = new Client;
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => config('services.recaptcha.secret'),
                        'response' => $captchaResponse,
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());

            //        if (!$body || $body->success) {
            //            request()->validate(['g-recaptcha' => 'Invalid captcha code.']);
            //        }

        if (!$body||!$body->success) {
            return false;
        }
        return true;
    }
    private function s3Upload($file_path,$file_name,$file)
    {
       try {
           if($file){
                $path = Storage::disk('s3')->put($file_path, $file);
                // $path = Storage::disk('s3')->putFileAs($file_path, $file,$file_name,'public');
                // $request->merge([
                //     'size' => $request->file->getClientSize(),
                //     'path' => $path
                // ]);
                return Storage::disk('s3')->url($path);
                // return $path;
            }else{
                return false;
            }
       } catch (Exception $ex) {
           Log::error($ex);
        //    dd($ex);
        return false;
       }
       
    }

}