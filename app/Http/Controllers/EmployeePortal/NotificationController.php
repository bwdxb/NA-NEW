<?php

namespace App\Http\Controllers\EmployeePortal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UtilTrait;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Log;


class NotificationController extends Controller
{
    

    public function seenBy($id)
    {
        try {
          $notificationData=Notification::find($id);
          if($notificationData){
            if(!in_array(Auth::id(),explode(',',$notificationData->seen_by))){
				$notificationData->seen_by= $notificationData->seen_by.Auth::id().",";
				$notificationData->save();
			}
            return redirect($notificationData->url);
          }
          return redirect()->route('employee-portal.notifications');
        } catch (\Exception $ex) {
            $this->exceptionLog($ex);
            Log::error($ex);
            return redirect()->route('employee-portal.notifications');
        }
    }

}