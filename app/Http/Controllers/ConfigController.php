<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Traits\RequestManageEngineTrait;
use App\Http\Controllers\Traits\SmsTrait;
use App\Config;
use Auth;
use Carbon\Carbon;
use DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;
use Mail;
use Session;
use Exception;
use Illuminate\Support\Facades\Log;




class ConfigController extends Controller
{
    use RequestManageEngineTrait;
    use MailTrait;
    use SmsTrait;

    public function courseChangeStatus()
    {
        try {
            
            $configData = Config::where('type',"COURSE_STATUS_BUTTON")->first();
            if($configData){
                if($configData->status){
                    $configData->status = 0;
                }else{
                    $configData->status = 1;
                    
                }
                $configData->updated_by = Auth::id();
                $configData->save();
                Session::flash('success', 'Course Button Status Changed.');
            }else{
                Session::flash('success', 'No Config Found.');
            }
            
        } catch (\Exception $ex) {
            // dd($ex);
           Log::error($ex);
           Session::flash('error', 'Internal Server Error Occured, Please try again later...');
        }
        return redirect()->back();
    }
    public function careerChangeStatus()
    {
        try {
            
            $configData = Config::where('type',"CAREER_STATUS_BUTTON")->first();
            if($configData){
                if($configData->status){
                    $configData->status = 0;
                }else{
                    $configData->status = 1;
                    
                }
                $configData->updated_by = Auth::id();
                $configData->save();
                Session::flash('success', 'Career Button Status Changed.');
            }else{
                Session::flash('success', 'No Config Found.');
            }
            
        } catch (\Exception $ex) {
            // dd($ex);
           Log::error($ex);
           Session::flash('error', 'Internal Server Error Occured, Please try again later...');
        }
        return redirect()->back();
    }
}