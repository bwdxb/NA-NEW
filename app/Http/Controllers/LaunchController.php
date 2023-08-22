<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use Auth;
use App\LaunchConfig; 
use DB; 
use Log; 
use Session; 
use app\Http\helper\Helper as Helper;
use Catbon\Carbon;


class LaunchController extends Controller
{
    public function index(Request $request)
    {
        $data = LaunchConfig::find(1);
       
        return view('Admins.website_launch_management.index',compact('data'));
    }

    public function reset()
    {
      try {
        $data = LaunchConfig::find(1);
        $data->status=0;
        $data->save();
      } catch (\Exception $th) {
          Log::error($th);
      }
        return redirect('/login');
    }
    public function launch()
    {
        $data = LaunchConfig::find(1);
        $data->status=1;
        $data->save();
       
        return redirect('/');
    }
	
}

