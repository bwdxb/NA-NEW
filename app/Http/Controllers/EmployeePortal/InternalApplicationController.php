<?php

namespace App\Http\Controllers\EmployeePortal;

use App\Http\Controllers\Controller;
use App\InternalApplication;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Image;
use File;

class InternalApplicationController extends Controller
{

    /*
     * todo (Employee Middleware): authenticate loggedin user trying to access the InternalApplication features are of type/role Employee
     * */

    public function index()
    {
        $data = InternalApplication::orderBy('created_at', 'desc')->get();

        return view('employee_portal.internal_application')->with(compact('data'));
        // return view('employee_portal.internal_application');
    }

    public function admin_view()
    {
        $data = InternalApplication::orderBy('created_at', 'desc')->get();

        return view('employee_portal.admin_internal_application')->with(compact('data'));
        // return view('employee_portal.internal_application');
    }

    public function internal_application()
    {
        $data = InternalApplication::orderBy('created_at', 'desc')->get(8);
        return view('employee_portal.admin_internal_application')->with(compact('data'));
        // return view('employee_portal.admin_internal_application');
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'op_type' => 'sometimes|required|in:create,update',
            'title' => 'sometimes|required_if:op_type,==,create',
            'url' => 'sometimes|required_if:op_type,==,create',
            'logo' => 'sometimes|required_if:op_type,==,create|mimes:jpg,jpeg,png,bmp,svg|max:20000',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        if ($request->op_type == 'create') {
            $newInternalApplicationData = new InternalApplication();
            $newInternalApplicationData->title = $request->title;
            $newInternalApplicationData->url = $request->url;
            $newInternalApplicationData->logo = $request->logo;
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $media_type = explode('/', $image->getMimeType())[0];
               dd($image->getMimeType());
                if($media_type=='image' && explode('/', $image->getMimeType())[1]!='svg'){
                    $img = Image::make($image->path());
                    // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                    $img->resize(300, 300, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                    $file_url='public/uploads/internal_applications/' . $new_name;
                    $img->save($file_url, 75);
                    $newInternalApplicationData->logo='uploads/internal_applications/' . $new_name;
                }else{
                    $image->move(public_path('uploads/internal_applications'), $new_name);
                    $newInternalApplicationData->logo = "uploads/internal_applications/" . $new_name;
                }
            }
            if ($newInternalApplicationData->save()) {
                $newInternalApplicationData->fresh();
                $expiry = Carbon::parse($newInternalApplicationData->created_at)->addMonths(2)->format('Y-m-d H:i:s');
                Session::flash('success', 'Team salute added successfully');
                return redirect()->route('employee-portal.internal-application.admin_view');
            } else {
                Session::flash('error', 'Failed to add team salute');
                //$data = InternalApplication::orderBy('created_at', 'desc')->paginate(8);
//            return redirect()->back()->with(compact('data'))->withInput();
                return redirect()->back()->withInput();
            }

            //$data = InternalApplication::orderBy('created_at', 'desc')->paginate(8);
//        return view('employee_portal.admin_internal_application')->with(compact('data'));
        } else {

            if (!isset($request->id)) {
                Session::flash('error', 'Failed to update the record');
                return redirect()->back()->withInput();
            }

            $docs = InternalApplication::find($request->id);
            // dd($docs);
            if (!$docs) {
                Session::flash('error', 'Failed to update the record');
                return redirect()->back()->withInput();
            }
            // dd($request->all());
            $data = $request->all();

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $media_type = explode('/', $image->getMimeType())[0];
                if($media_type=='image' && explode('/', $image->getMimeType())[1]!='svg'){
                
                    $img = Image::make($image->path());
                    // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                    $img->resize(300, 300, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                    $file_url='public/uploads/internal_applications/' . $new_name;
                    $img->save($file_url, 75);
                }else{
                    $image->move(public_path('uploads/internal_applications'), $new_name);
                $request->logo = 'uploads/internal_applications/' . $new_name;
                }
                $data['logo'] = 'uploads/internal_applications/' . $new_name;
            } else {
                unset($data['logo']);
            }
            $update = $docs->update($data);
            // dd([$docs->refresh()]);
            if ($update) {
                Session::flash('success', 'Successfully updated the record');
                return redirect()->route('employee-portal.internal-application.admin_view');
            } else {
                Session::flash('error', 'Failed to update the record');
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateDashboard(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'app_ids' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        $app_ids = $request->app_ids;
        $totCount = count($app_ids);

        while (in_array(0, $app_ids)) {
            $pos = array_search(0, $app_ids);// Search for value 0
            unset($app_ids[$pos]);// Remove 0 from $userPackages
        }
        $trueCount = count($app_ids);
        $falseCount = $totCount - $trueCount;

        $apps = InternalApplication::whereIn('id',$app_ids)
        ->update([
            'selected' => 1
        ]);
        if ($apps != $trueCount) {
            Session::flash('error', 'Failed to update records');
            return redirect()->back();
        }

        $apps = InternalApplication::whereNotIn('id',$app_ids)
        ->update([
            'selected' => 0
        ]);
        if ($apps != $falseCount) {
            Session::flash('error', 'Failed to update records');
            return redirect()->back();
        }

        Session::flash('success', 'Updated records successfully');
        return redirect()->back();
    }

    public function update($id)
    {
        // dd($id);

        if (!$id) {
            Session::flash('error', 'Failed to get the record');
            return redirect()->back();
        }

        $docs = InternalApplication::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to get the record');
            return redirect()->back();
        }

        // Session::flash('success', 'Successfully get the record');
        $data = InternalApplication::orderBy('created_at', 'desc')->get();
        // dd($docs);
        return view('employee_portal.admin_internal_application', ['update' => $docs, 'data' => $data]);
        // return view('employee_portal.admin_internal_application', ['data' => $docs]);
    }

    public function delete($id)
    {
        // dd($id);
        if (!$id) {
            Session::flash('error', 'Failed to delete the record');
            return redirect()->back();
        }

        $docs = InternalApplication::find($id);
        if (!$docs) {
            Session::flash('error', 'Failed to delete the record');
            return redirect()->back();
        }

        $delete = $docs->delete();

        if ($delete) {
            Session::flash('success', 'Successfully deleted the record');
        } else {
            Session::flash('error', 'Failed to delete the record');
        }
        return redirect()->route('employee-portal.internal-application.admin_view');
    }
}