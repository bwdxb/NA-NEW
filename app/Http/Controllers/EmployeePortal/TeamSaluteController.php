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


class TeamSaluteController extends Controller
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
        return view('employee_portal.team_salute',['team_salutes'=>$data]);
        // return view('employee_portal.team_salute');
    }

    public function team_salute(Request $request)
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
        // $data = TeamSalute::where('created_by',Auth::id())->orderBy('created_at', 'desc')->paginate(8);
        // return view('employee_portal.team_salute')->with(compact('data'));
        return view('employee_portal.team_salute',['team_salutes'=>$data]);
        // return view('employee_portal.team_salute');
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'op_type' => 'sometimes|required|in:create,update',
            'ts_for' => 'sometimes|required_if:op_type,==,create',
            'ts_from' => 'sometimes|required_if:op_type,==,create',
            'ts_to' => 'sometimes|required_if:op_type,==,create',
            'ts_date' => 'sometimes|required_if:op_type,==,create',
            //'category' => 'sometimes|required_if:op_type,==,create',
            'category' => 'required',
            'agreement' => 'required',            
        ],
        ['category.required' => 'Please select category',
        'ts_for.required_if' => 'Please add a message',
        'agreement.required'=>'Please select the checkbox for Terms and Conditions']);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        if ($request->op_type == 'create') {
          
            $newTeamSaluteData = new TeamSalute();
            $newTeamSaluteData->ts_for = $request->ts_for;
            $newTeamSaluteData->ts_from = $request->ts_from;
            $newTeamSaluteData->ts_to = $request->ts_to;
            $newTeamSaluteData->ts_date = Carbon::parse($request->ts_date);
            $newTeamSaluteData->category = $request->category;
            $newTeamSaluteData->created_by = Auth::id();

            if ($newTeamSaluteData->save()) {
                $newTeamSaluteData->fresh();
                $expiry = Carbon::parse($newTeamSaluteData->created_at)->addMonths(2)->format('Y-m-d H:i:s');
                Session::flash('success', 'Team salute added successfully');
                return redirect()->route('employee-portal.team-salute.view');
            } else {
                Session::flash('error', 'Failed to add team salute');
                //$data = TeamSalute::orderBy('created_at', 'desc')->paginate(8);
                //            return redirect()->back()->with(compact('data'))->withInput();
                return redirect()->back()->withInput();
            }
            
            //$data = TeamSalute::orderBy('created_at', 'desc')->paginate(8);
            //        return view('employee_portal.team_salute')->with(compact('data'));
        } else {
            if (!isset($request->id)) {
                Session::flash('error', 'Failed to update the Document');
                return redirect()->back()->withInput();
            }
            
            $docs = TeamSalute::find($request->id);
            // dd($docs);
            if (!$docs) {
                Session::flash('error', 'Failed to update the Document');
                return redirect()->back()->withInput();
            }
            // dd($request->all());
            $docs->ts_for = $request->ts_for;
            $docs->ts_from = $request->ts_from;
            $docs->ts_to = $request->ts_to;
            $docs->ts_date = Carbon::parse($request->ts_date);
            $docs->category = $request->category;
            // dd(Carbon::parse($request->ts_date));            
            $update = $docs->save();
            // dd($docs);            
            // dd([$docs->refresh()]);
            if ($update) {
                Session::flash('success', 'Successfully updated the Document');
                return redirect()->route('employee-portal.team-salute.view');
            } else {
                Session::flash('error', 'Failed to update the Document');
                return redirect()->back()->withInput();
            }
        }   
    }
    public function update($id)
    {
    // dd($id);

        if (!$id) {
            Session::flash('error', 'Failed to get the Document');
            return redirect()->back();
        }

        $docs = TeamSalute::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to get the Document');
            return redirect()->back();
        }

        // Session::flash('success', 'Successfully get the Document');
        $data = TeamSalute::orderBy('created_at', 'desc')->paginate(8);
    // dd($docs);
        return view('employee_portal.team_salute', ['update' => $docs, 'data' => $data]);
    // return view('employee_portal.team_salute', ['data' => $docs]);
    }

    public function delete($id)
    {
        // dd($id);
        if (!$id) {
            Session::flash('error', 'Failed to delete the Document');
            return redirect()->back();
        }

        $docs = TeamSalute::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to delete the Document');
            return redirect()->back();
        }

        $delete = $docs->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted the Document');
        } else {
            Session::flash('error', 'Failed to delete the Document');
        }
        return redirect()->route('employee-portal.team-salute.view');
    }
    public function adminDelete($id)
    {
        // dd($id);
        if (!$id) {
            Session::flash('error', 'Failed to delete team salute');
            return redirect()->back();
        }

        $docs = TeamSalute::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to delete team salute');
            return redirect()->back();
        }

        $delete = $docs->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted team salute');
        } else {
            Session::flash('error', 'Failed to delete team salute');
        }
        return redirect()->route('employee-portal.team-salute.admin.list');
    }

    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filter' => 'required',
            'sort' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to fetch filtered stories');
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        // dd($request->all());

        $salute = TeamSalute::query();


        if ($request->filter != 'All') {

            $user = Auth::user();
            $name = $user->first_name . ' ' . $user->last_name;

            switch ($request->filter) {
                case 'Recieved Salutes':
                $salute = $salute->where('ts_to',$name);
                // dd([
                //     'request'=>$request->all(),
                //     'type'=>'ts_to',
                //     'name'=>$name,
                //     'query'=>$salute->toSql(),
                //     'data'=>$salute->get(),
                // ]);
                break;
                case 'Sent Salutes':
                $salute = $salute->where('ts_from', $name);
                // dd([
                //     'request'=>$request->all(),
                //     'type'=>'ts_from',
                //     'name'=>$name,
                //     'query'=>$salute->toSql(),
                //     'data'=>$salute->get(),
                // ]);
                break;
                default:
                $salute = $salute->where('category',$request->filter);
            }
        }


        switch ($request->sort) {
            case 'latest':
            $salute = $salute->groupby('created_at', 'updated_at')->latest();
            break;
            default:
            $salute = $salute->groupby('created_at', 'updated_at')->oldest();
        }

        $salute = $salute->paginate(8);

        // Session::flash('success', 'Successfully retrieved filtered stories');
        return view('employee_portal.team_salute', ['data' => $salute, 'filter' => $request->all()]);
    }


}