<?php

namespace App\Http\Controllers\EmployeePortal;

use App\Http\Controllers\Controller;
use App\TeamSalute;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;


class TermAndConditionsController extends Controller
{

    /*
     * todo (Employee Middleware): authenticate loggedin user trying to access the TeamSalute features are of type/role Employee
     * */

    public function adminFetch(Request $request)
    {
        $data = TeamSalute::query();

        if(isset($request->filter)){
            if ($request->filter != 'All') {

                $user = Auth::user();
                $name = $user->first_name . ' ' . $user->last_name;
    
                switch ($request->filter) {
                    case 'Recieved Salute':
                    $data = $data->where('ts_to',$name);
                    // dd([
                    //     'request'=>$request->all(),
                    //     'type'=>'ts_to',
                    //     'name'=>$name,
                    //     'query'=>$data->toSql(),
                    //     'data'=>$data->get(),
                    // ]);
                    break;
                    case 'Sent Salute':
                    $data = $data->where('ts_from', $name);
                    // dd([
                    //     'request'=>$request->all(),
                    //     'type'=>'ts_from',
                    //     'name'=>$name,
                    //     'query'=>$data->toSql(),
                    //     'data'=>$data->get(),
                    // ]);
                    break;
                    default:
                    $data = $data->where('category',$request->filter);
                }
            }
        }


       if(isset($request->sort)){ 
            switch ($request->sort) {
                case 'latest':
                $data = $data->latest();
                break;
                default:
                $data = $data->oldest();
            }
        }else{
            $data = $data->latest();

        }

        $data = $data->paginate(8);
        return view('employee_portal.admin_team_salute',['data'=>$data]);
        // return view('employee_portal.team_salute');
    }

    public function index(Request $request)
    {        
        return view('employee_portal.term_and_conditions');    
    }

}