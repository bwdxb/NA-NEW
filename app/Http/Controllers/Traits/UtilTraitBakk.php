<?php


namespace App\Http\Controllers\Traits;

use App\Http\classes\paytabs;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait UtilTraitBakk
{
//    private function uat_admin_mail($user_data)
//    {
//
////        Mail::send(['text' => 'uat_admin_mail'], $user_data, function ($message) use ($user_data) {
//        // Mail::send(['text' => 'bakk.uat_admin_mail'], $user_data, function ($message) use ($user_data) {
//        // Mail::send('bakk.uat_admin_mail', $user_data, function ($message) use ($user_data) {
//        Mail::send('bakk.uat_admin_mail', $user_data, function ($message) use ($user_data) {
//            $message->to('info@uatfresh.com', config('app.name') . ' Administrator')
//            ->subject(config('app.name') . ' Order Alert !!!')
//            ->from(config('mail.username'), config('app.name') . ' DEV Team');
//        });
//    }
//
//    private function uat_user_mail($user_data)
//    {
//        Log::error('mail data : '.json_encode($user_data));
////        Mail::send(['text' => 'uat_user_mail'], $user_data, function ($message) use ($user_data) {
//        // Mail::send(['text' => 'bakk.uat_user_mail'], $user_data, function ($message) use ($user_data) {
//        // Mail::send('bakk.uat_user_mail', $user_data, function ($message) use ($user_data) {
//        Mail::send('uat_user_mail', $user_data, function ($message) use ($user_data) {
//            $message->to($user_data['email'], $user_data['username'])
//            // $message->to('aldrin.think@gmail.com', $user_data['username'])
//            ->subject(config('app.name') . ' Order Status Alert !!!')
//            ->from(config('mail.username'), 'Team' . config('app.name'));
//        });
//    }
//
//    private function uat_user_messenger($mobileno, $message)
//    {
//        $url = config('mshastra.url');
//        $user = config('mshastra.username');
//        $pwd = config('mshastra.password');
//        $sender_id = config('mshastra.sender_id');
//
//        // $api = $url . 'user=' . $user . '&pwd=' . $pwd . '&senderid=' . $sender_id . '&mobileno=' . $mobileno . '&msgtext=' . $message . '&priority=High&CountryCode=ALL';
//        $api = $url . 'user=' . $user . '&pwd=' . $pwd . '&senderid=' . $sender_id . '&mobileno=971' . $mobileno . '&msgtext=' . $message . '&CountryCode=ALL';
//        // $api = $url . 'user=' . $user . '&pwd=' . $pwd . '&senderid=' . $sender_id . '&mobileno=+971551615283&msgtext=' . $message . '&CountryCode=All';
//        Log::error('message api request : '. $api);
//        $res = Http::get($api);
//        Log::error('message api response : '. $res);
//        if($res.'' == 'Enter text message.')
//            $res = '';
//
//        return $res;
//    }
//
//    private function uat_admin_messenger($message)
//    {
//        $url = config('mshastra.url');
//        $user = config('mshastra.username');
//        $pwd = config('mshastra.password');
//        $sender_id = config('mshastra.sender_id');
//        $mobileno = config('mshastra.admin_mob_1') . ',' . config('mshastra.admin_mob_2');
//
//        $api = $url . 'user=' . $user . '&pwd=' . $pwd . '&senderid=' . $sender_id . '&mobileno=' . $mobileno . '&msgtext=' . $message . '&priority=High&CountryCode=ALL';
//        Log::error('message api request : '. $api);
//        $res = Http::get($api);
//        Log::error('message api response : '. $res);
//
//        return $res;
//    }
//
//    private function get_local_time()
//    {
//
//        $ip = file_get_contents("http://ipecho.net/plain");
//
//        $url = 'http://ip-api.com/json/' . $ip;
//
//        $tz = file_get_contents($url);
//
//        $tz = json_decode($tz, true)['timezone'];
//
//        return $tz;
//
//    }
//
//    private function initPay($payArr)
//    {
////        $pt = new paytabs(trim(config('paytab.email')), trim(config('paytab.key')));
//        $pt = new paytabs(trim(config('paytab.email')), '0OIbFMiIw4ORI0OaTj9M5PJUgAFqUIBUxk5c7nVDrKuaKjkECuqIj9DAJi0D1CyyWDL40HHsrcDcvXQ8shRLrulbMmPNYnmV08Z1');
//
//        Log::error('payArr : ' . json_encode($payArr));
////        $authentication = $pt->authentication();
////        Log::error('authentication response : ' . str($authentication));
////        if (!$authentication) {
////            return compact([
////                'response_code' => 4002 //invalid
////            ]);
////        }
//        $result = $pt->create_pay_page($payArr);
//
////        Log::error('card pay response : ' . json_encode($result));
//        Log::error('card pay response : ' . json_encode($result));
////        return $result->response_code;
//        return $result;
////        echo '<script type="text/javascript"> window.location = "' . $result->payment_url . '"</script>';
////        print_r($result);
//    }

}