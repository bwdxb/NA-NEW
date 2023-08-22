<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Notification;
use App\Role;
use App\User;
use App\TeamSalute;
use App\Story;
use App\StoryLike;
use App\StoryView;
use App\HeadsUp;
use App\MarketPlace;
use App\MarketItemImages;
use App\MarketProductInterests;
use App\Todo;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Hash;
use Log;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();
        $users= $users->where("gst_no",null);
        // $users = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id');
        if ($request->first_name != null && isset($request->first_name)) {
            // $users = $users->where('first_name', 'LIKE', '%' . $request->first_name . '%')->orWhere('last_name', 'LIKE', '%' . $request->first_name . '%');
            $users= $users->where(function($query) use ($request) {

                $query->where('first_name', 'LIKE', '%' . $request->first_name . '%')->orWhere('last_name', 'LIKE', '%' . $request->first_name . '%');
             });
        }
       

        if ($request->mobile != null && isset($request->mobile)) {
            $users = $users->where('mobile', 'LIKE', '%' . $request->mobile . '%');
    

        }
        if ($request->email != null && isset($request->email)) {
            $users = $users->where('email', 'LIKE', $request->email . '%');
    

        }

      
        // $users = $users->select('users.id', 'roles.role_name', 'users.user_name', 'users.first_name', 'users.last_name', 'users.email', 'users.mobile', 'users.designation','users.status', 'users.updated_by');
        if($request->limit){
            $users=$users->latest()->paginate($request->limit);
        }else{
            
            $users=$users->latest()->paginate(10);
        }
        // dd($users);

        


        return view('Admins.user_management.index', compact('users'))
        ->with('i', 1);
    }

    public function create()
    {
        $allRoles = Role::where('IsActive', 1)->orderBy('id')->pluck('role_name', 'id');
        return view('Admins.user_management.create', compact('allRoles'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $user = new AdminUser();
        $isAlreadyExist = AdminUser::where('email',$request->email)->where('gst_no',null)->first();
            if($isAlreadyExist){
                Session::flash('error', 'User with email-id already exist.');
                return redirect()->back()->withInputs($request->all());

            }
        //$user->role_id = $request->role_id;
        $user->user_name = $request->user_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->designation = $request->designation;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);

        if ($user->save()) {

            Session::flash('message', 'User has been added successfully');
            // return redirect()->route('user.index');
        } else {
            Session::flash('error', 'User not added successfully');
            // return redirect()->route('user.index');
        }

        return redirect()->route('user.create');
    }

    public function edit($id)
    {
        $user = AdminUser::where('id', $id)->first();
        $allRoles = Role::where('IsActive', 1)->orderBy('id')->pluck('role_name', 'id');
        return view('Admins.user_management.edit', compact('user', 'allRoles'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = AdminUser::where('id', $id)->first();
        $user->role_id = $request->role_id;
        $user->user_name = $request->user_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->designation = $request->designation;

        if ($user->save()) {

            Session::flash('message', 'User has been updated successfully');
            // return redirect()->route('user.index');
        } else {
            Session::flash('error', 'User has been updated successfully');
            // return redirect()->route('user.index');
        }
        return redirect()->route('user.create');
    }

    public function delete($id)
    {
        $contact = AdminUser::find($id);
        // TeamSalute::where('created_by',$id)->delete();
        // Story::where('created_by',$id)->delete();
        // StoryLike::where('created_by',$id)->delete();
        // StoryView::where('created_by',$id)->delete();
        // HeadsUp::where('created_by',$id)->delete();
        // MarketPlace::where('created_by',$id)->delete();
        // Todo::where('employee_id',$id)->delete();
        // Notification::where('created_by',$id)->delete();


        // if ($contact->delete()) {

        //     Session::flash('message', 'User has been deleted successfully');
        //     // return redirect()->route('user.index');
        // } else {
        //     Session::flash('error', 'User not deleted successfully');
        //     // return redirect()->route('user.index');
        // }
        return redirect()->route('user.index');
    }

    public function softdelete($id){// attribute gst_no is used for the softdelete staus check if null not deleted if not null stated as deleted
        $contact = AdminUser::find($id);
        $contact->gst_no=1;
        if($contact->save()){
            
            Session::flash('message', 'User has been removed successfully');
            Session::flash('success', 'User has been removed successfully');
        }else{
            Session::flash('error', 'Failed to delete user');

        }
        return redirect()->route('user.index');

    }
    public function status($id)
    {

        $contact = AdminUser::where('id', $id)->first();

        if ($contact->status == 1) {
            $contact->status = 0; //0 for Block
            $contact->save();

        } else $contact->status = 1; //1 for Unblock
        $contact->save();

        if ($contact->status == 1) {
            return 1;
        } else {
            return 2;
        }

    }

    public function profileshow(Request $request)
    {

        $user = User::where('id', '=', Auth::user()->id);

        $user = $user->get();

        return view('Admin.profile.profile', compact('user'));
    }

    public function profileupdate(Request $request)
    {

        $id = Auth::user()->id;

        DB::table('users')->where('id', $id)->update(array('email' => $request->email));
        Session::flash('message', 'Your profile has been updated successfully');
        Session::flash('success', 'Your profile has been updated successfully');

        return redirect('/profile');


    }

    public function changepassform(Request $request)
    {
        return view('Admin.profile.changepass');

    }

    public function changepassword(Request $request, $userId)
    {
        // dd($request->all());
        if (!$userId){
            session()->flash('error', 'old password doesnt matched ');
            return redirect()->back();
        }

        $user = User::find($userId);
        if (!$user){
            session()->flash('error', 'old password doesnt matched ');
            return redirect()->back();
        }
        if ($request->newpassword == $request->confirmpassword) {

            $update = $user->update([
                'password'=>bcrypt($request->newpassword),
            ]);

            
            if ($update) {
                session()->flash('success', 'password updated successfully');
                session()->flash('message', 'password updated successfully');
            }else{
                session()->flash('error', 'failed to update new password');
            }
            return redirect()->back();
        } else {
            session()->flash('error', 'failed to update new password');
            return redirect()->back();
        }

    }

    // public function changepassword(Request $request)
    // {
    //     $hashedPassword = Auth::user()->password;

    //     if (\Hash::check($request->oldpassword, $hashedPassword)) {

    //         if (!\Hash::check($request->newpassword, $hashedPassword)) {

    //             $users = user::find(Auth::user()->id);
    //             $users->password = bcrypt($request->newpassword);
    //             user::where('id', Auth::user()->id)->update(array('password' => $users->password));

    //             session()->flash('message', 'password updated successfully');
    //             return redirect()->back();
    //         } else {
    //             session()->flash('error', 'new password can not be the old password!');
    //             return redirect()->back();
    //         }

    //     } else {
    //         session()->flash('error', 'old password doesnt matched ');
    //         return redirect()->back();
    //     }

    // }
    public  function envUpdate($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));
        }
    }
    public function emailConfig(Request $request)
    {
        try {
            $env_data=$request->all();
            unset($env_data['_token']);
            // dd($env_data);
            foreach($env_data as $key=>$value){
                $this->envUpdate($key,$value);
            }
            Session::flash('success','Email config updated');
        } catch (\Exception $th) {
            Log::error($th);
            Session::flash('error','failed to update config');
        }
        return redirect()->route('email-config.view');
    }
    public function emailConfigView(Request $request)
    {
        
        return view('profile.config');
    }
}