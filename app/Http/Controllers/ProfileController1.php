<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Session;

class ProfileController extends Controller
{

    public function update(Request $request)
    {
        try {

            $id = Auth::id();
            if (!$id) {
                Session::flash('error', 'Failed to update profile, Please try again later...');
                return back();
            }

            $propicUrl = '';
            if (!empty($request->file('propic'))) {
                $propic = $request->file('propic');
                $propicName = rand(1000, 9999) . '.' . $propic->getClientOriginalExtension();
                $propic->move(public_path('/uploads/profile/'), $propicName);
                $propicUrl = '/public/uploads/profile/' . $propicName;
            }
            $user = User::find($id);
            unset($request['email']);
            $update = $user->update($request->all() + ['image' => $propicUrl]);

            if (!$update) {
                Session::flash('error', 'Failed to update profile, Please try again later...');
            } else {
                Session::flash('success', 'Updated profile successfully');
            }
            return back();
        } catch (\Exception $ex) {
            //            dd([
            //                'exception message' => $ex->getMessage(),
            //                // 'exception in'=>$ex->getFile(),
            //                'exception line no.' => $ex->getLine(),
            //                // 'exception trace'=>$ex->getTrace(),
            //            ]);

            Session::flash('error', 'Internal Server Error Occured, Please try again later...');
            return back();
        }
    }

    //    public function viewUpdatePassword()
    //    {
    //        try {
    //
    //        } catch (\Exception $ex) {
    ////            dd([
    ////                'exception message' => $ex->getMessage(),
    ////                // 'exception in'=>$ex->getFile(),
    ////                'exception line no.' => $ex->getLine(),
    ////                // 'exception trace'=>$ex->getTrace(),
    ////            ]);
    //
    //            Session::flash('error', 'Internal Server Error Occured, Please try again later...');
    //            return back();
    //        }
    //    }

    public function updatePassword(Request $request)
    {
        // dd($request->all());
        try {
            //            $hashedPassword = Auth::user()->password;
            //            if (\Hash::check(trim($request->oldpassword), $hashedPassword)) {

            //                if (!\Hash::check($request->newpassword, $hashedPassword)) {
            if ($request->password == $request->password_confirmation) {
                $user = User::find(Auth::id());
                $update = $user->update([
                    'password' => bcrypt($request->password),
                ]);

                if (!$update) {
                    Session::flash('message', 'password updated failed');
                } else {
                    // Session::flash('message', 'password updated successfully');
                    Session::flash('message', 'Your password updated successfully');
                    Session::flash('success', 'Your password updated successfully');
                }

                return redirect()->back();
            } else {
                Session::flash('error', 'new password can not be the old password!');
                return redirect()->back();
            }

            //            } else {
            //                Session::flash('error', 'old password doesnt matched ');
            //                return redirect()->back();
            //            }
        } catch (\Exception $ex) {
            //            dd([
            //                'exception message' => $ex->getMessage(),
            //                // 'exception in'=>$ex->getFile(),
            //                'exception line no.' => $ex->getLine(),
            //                // 'exception trace'=>$ex->getTrace(),
            //            ]);

            Session::flash('error', 'Internal Server Error Occured, Please try again later...');
            return back();
        }
    }
}
