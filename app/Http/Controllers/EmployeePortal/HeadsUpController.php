<?php

namespace App\Http\Controllers\EmployeePortal;

use App\HeadsUp;
use App\Notification;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
use Carbon\Carbon;


class HeadsUpController extends Controller
{

    /*
     * todo (Employee Middleware): authenticate loggedin user trying to access the MarketPlace features are of type/role Employee
     * todo <Note : particularly Department Heads or C-Levels>
     * */

    public function fetch(Request $request)
    {

        $data = HeadsUp::query();
        if (isset($request->search)) {
            $data = $data->where("title", "LIKE",trim($request->search).'%');

        }
        if (isset($request->year)) {
            $data = $data->whereYear("created_at", (int)$request->year);

        }
        if (isset($request->month)) {
            $data = $data->whereMonth("created_at",(int)$request->month);

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
    $data = $data->paginate();
    $heads_up_today = HeadsUp::orderBy('created_at', 'desc')->limit(5)->get();
    // $heads_up_today = HeadsUp::whereDate('created_at', Carbon::today())->get();

        return view('employee_portal.heads_up', ['data' => $data,'heads_up_today'=>$heads_up_today]);
    }

    public function adminfetch(Request $request)
    {
        $data = HeadsUp::query();
        if (isset($request->search)) {
            $data = $data->where("title", "LIKE",trim($request->search).'%');

        }
        if (isset($request->year)) {
            $data = $data->whereYear("created_at", (int)$request->year);

        }
        if (isset($request->month)) {
            $data = $data->whereMonth("created_at",(int)$request->month);

        }
        
        if(isset($request->sort)){
           switch ($request->sort) {
            case 'latest':
                $data = $data->latest();
                break;
            default:
                $data = $data->oldest();
            } 
        }
    $data = $data->paginate();
    $heads_up_today = HeadsUp::orderBy('created_at', 'desc')->limit(5)->get();
    // $heads_up_today = HeadsUp::whereDate('created_at', Carbon::today())->get();

        return view('employee_portal.admin_heads_up', ['data' => $data,'heads_up_today'=>$heads_up_today]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'sometimes',
            'title' => 'required',
            'from_' => 'sometimes',
//            'from_' => 'required_without:id',
//            'file' => 'required_without:id|mimes:jpg,jpeg,png,bmp,mp4,mov,oga,ogv,ogg,webm',
            'file' => 'sometimes',
            'description' => 'sometimes',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Failed to upload the Media Content');
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $media_type = '';
       
        $file_url=null;
        if(isset($request->file)&&count($request->file)>0){
            $file_url=[];
            foreach ($request->file as  $fileData) {
                if($fileData){
                 $file = $fileData;
                 $media_type = explode('/', $file->getMimeType())[0];
                 $file_name = $media_type."-".rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                 $file->move(public_path('uploads/heads_up'), $file_name);
                  array_push($file_url,'public/uploads/heads_up/' . $file_name);
                }
             }
             $file_url= implode(',',$file_url);
             
             // if ($request->hasFile('file')) {
             //     $file = $request->file('file');
             //     $media_type = explode('/', $file->getMimeType())[0];
             //     $file_name = rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
             //     $file->move(public_path('uploads/heads_up'), $file_name);
             //     $file_url = 'public/uploads/heads_up/' . $file_name;
             // } else {
             //     $file_url = 'public/uploads/news/5 years.jpg';
             // }
        }
        // dd($file_url);
        // dd($request->all());
        if ($request->id) {
            $headsUpContent = HeadsUp::find($request->id);
            if (!$headsUpContent) {
                Session::flash('error', 'Failed to update the Media Content');
                return redirect()->back()->withInput();
            }
            $data = $request->all();
            if (isset($file_url) ) {
                $data['file_url'] = $file_url;
            }else{
                $data['file_url'] = $headsUpContent->file_url;

            }
            if ($media_type !== '') {
                $data['media_type'] = $media_type;
            }

            $update = $headsUpContent->update($data);

            if ($update) {
                Session::flash('success', 'Successfully updated the Media Content');
                return redirect()->route('employee-portal.heads-up.admin_view');
            } else {
                Session::flash('error', 'Failed to update the Media Content');
                return redirect()->back()->withInput();
            }
        } else {
            $headsUpContent = HeadsUp::create($request->all() + [
                    'media_type' => $media_type,
                    'file_url' => $file_url,
//                    'created_by' => Auth::id(),
                    'created_by' => 1,
                ]
            );

            if ($headsUpContent) {
                $notificationData = new Notification();
                $notificationData->title="Heads-Up";
                $notificationData->type="headsup";
                $notificationData->created_by=Auth::id();
                $notificationData->description=$headsUpContent->title;
                $notificationData->url='/employee-portal/heads-up';
                $notificationData->save();
                Session::flash('success', 'Media Content has been added successfully');
                return redirect()->back();
            } else {
                Session::flash('error', 'Failed to upload the Media Content');
                return redirect()->back()->withInput();
            }
        }
    }

    public function update($id)
    {

        if (!$id) {
            Session::flash('error', 'Failed to get the Media Content');
            return redirect()->back();
        }

        $headsUpContent = HeadsUp::find($id);
        if (!$headsUpContent) {
            Session::flash('error', 'Failed to get the Media Content');
            return redirect()->back();
        }

        // Session::flash('success', 'Successfully get the Media Content');
        $data = HeadsUp::orderBy('created_at', 'desc')->paginate(8);
        // dd($headsUpContent);
        return view('employee_portal.admin_heads_up', ['update' => $headsUpContent, 'data' => $data]);
    }

    public function delete($id)
    {
        if (!$id) {
            Session::flash('error', 'Failed to delete the Media Content');
            return redirect()->back();
        }

        $headsUpContent = HeadsUp::find($id);
        if (!$headsUpContent) {
            Session::flash('error', 'Failed to delete the Media Content');
            return redirect()->back();
        }

        $delete = $headsUpContent->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted the Media Content');
        } else {
            Session::flash('error', 'Failed to delete the Media Content');
        }
        return redirect()->route('employee-portal.heads-up.admin_view');
    }

    public function filter(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'filter' => 'required',
        //     'sort' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     Session::flash('error', 'Failed to fetch filtered Media Content');
        //     return redirect()->back()->withErrors($validator)
        //         ->withInput();
        // }
// dd($request->all());

        $headsUpContents = HeadsUp::query();
        if (isset($request->year)) {
            $headsUpContents = $headsUpContents->whereYear("created_at", (int)$request->year);

        }
        if (isset($request->month)) {
            $headsUpContents = $headsUpContents->whereMonth("created_at",(int)$request->month);

        }
        if(isset($request->filter)){
            $filterCategory = explode('-', $request->filter);
        switch ($filterCategory[0]) {
            case 'all':
                break;
            default:
                $headsUpContents = $headsUpContents->where($filterCategory[1], $filterCategory[0]);
        }

        switch ($request->sort) {
            case 'latest':
                $headsUpContents = $headsUpContents->groupby('created_at', $filterCategory[1])->latest();
                break;
            default:
                $headsUpContents = $headsUpContents->groupby('created_at', $filterCategory[1])->oldest();
        }
    }else{
        if(isset($request->sort)){
           switch ($request->sort) {
            case 'latest':
                $headsUpContents = $headsUpContents->latest();
                break;
            default:
                $headsUpContents = $headsUpContents->oldest();
        } 
        }
        
    }
        // dd($headsUpContents->toSql());
        $headsUpContents = $headsUpContents->paginate();

        // Session::flash('success', 'Successfully retrieved filtered Media Content');
        return view('employee_portal.heads_up', ['data' => $headsUpContents, 'filter' => $request->all()]);
    }

    public function adminfilter(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'filter' => 'required',
        //     'sort' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     Session::flash('error', 'Failed to fetch filtered Media Content');
        //     return redirect()->back()->withErrors($validator)
        //         ->withInput();
        // }

        $headsUpContents = HeadsUp::query();
        if(isset($request->search)){
            $headsUpContents = $headsUpContents->where("title", "LIKE",$request->search.'%');

        }
        if (isset($request->year)) {
            $headsUpContents = $headsUpContents->whereYear("created_at", (int)$request->year);

        }
        if (isset($request->month)) {
            $headsUpContents = $headsUpContents->whereMonth("created_at",(int)$request->month);

        }
        if(isset($request->filter)){
            $filterCategory = explode('-', $request->filter);
        switch ($filterCategory[0]) {
            case 'all':
                break;
            default:
                $headsUpContents = $headsUpContents->where($filterCategory[1], $filterCategory[0]);
        }

        switch ($request->sort) {
            case 'latest':
                $headsUpContents = $headsUpContents->groupby('created_at', $filterCategory[1])->latest();
                break;
            default:
                $headsUpContents = $headsUpContents->groupby('created_at', $filterCategory[1])->oldest();
        }
    }else{
        if(isset($request->sort)){
           switch ($request->sort) {
            case 'latest':
                $headsUpContents = $headsUpContents->latest();
                break;
            default:
                $headsUpContents = $headsUpContents->oldest();
        } 
        }
        
    }
        // dd($headsUpContents->toSql());
        $headsUpContents = $headsUpContents->paginate();

        // Session::flash('success', 'Successfully retrieved filtered Media Content');
        return view('employee_portal.admin_heads_up', ['data' => $headsUpContents, 'filter' => $request->all()]);
    }

    public function updateHeadsupAttribute($attribute = 'view_count', $id)
    {
        if (!$id) {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to update Story',
            ));
        }
        $headsUp = HeadsUp::find($id);
        if (!$headsUp) {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to update Story',
            ));
        }

        $update = null;
        switch ($attribute) {
            case 'status':
                $status = ($headsUp->status == 'pending') ? 'approved' : 'pending';
                $update = $headsUp->update([
                    $attribute => $status
                ]);
                break;

            default:
                $update = $headsUp->increment($attribute);
        }


        if ($update) {
            $headsUp = $headsUp->fresh();
            return response()->json(array(
                'data' => $headsUp->$attribute,
                'response_code' => 200,
                'response_message' => 'Successfully updated',
            ));
        } else {
            return response()->json(array(
                'response_code' => 400,
                'response_message' => 'Failed to update',
            ));
        }
    }
}