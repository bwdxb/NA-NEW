<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        //echo "<pre>";
        //print_r($request->all());die;

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $remember_me = $request->has('remember') ? true : false;
        // dd($request->all());
        // Attempt to log the user in
        $users = Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
                'status' => 1,
            ],
            $remember_me
        );

        // dd([
        //     'auth attempt'=>$users,
        //     'auth user'=>Auth::user(),
        // ]);
        //echo Auth::user()->first_name;die;

        if (!$users) {
            Session::flash('error', "You have entered the wrong credentials.");
        } else {

            Session::put('role', "ADMIN");
            Session::put('LoggedUser.user_id', Auth::user()->id);
            Session::put('LoggedUser.email_address', Auth::user()->email);
            Session::put('LoggedUser.first_name', Auth::user()->first_name);
            Session::put('LoggedUser.last_name', Auth::user()->last_name);
            Session::put('LoggedUser.designation', Auth::user()->designation);
            Session::put('LoggedUser.image', Auth::user()->image);

            $res = $this->getUsersRolesPermissions(Session::get('LoggedUser.user_id'));

            Session::put('LoggedUser.allowedPasgeList', $res[0]);
            Session::put('LoggedUser.allowedPageCodeList', $res[1]); /* index of array is pageid */
            Session::put('LoggedUser.allowedPageActions', $res[2]);
            Session::put('LoggedUser.userRoleIDs', $res[3]);

            // if (Auth::user()->role_id == 1) {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 9) {
                return redirect()->intended(route('home'));
            } elseif (Auth::user()->role_id == 2) {
                return redirect()->intended(route('mall-admin.home'));
            } elseif (Auth::user()->role_id == 3) {
                Auth::logout();
                Session::forget('role');
                Session::flash('error', "You are not authorized to access the panel.");
                // return redirect()->intended(route('employee-portal.home'));
            } else {
                return redirect()->intended(route('home'));
                // Auth::logout();
                // Session::forget('role');
                // Session::flash('error', "You are not authorized to access the panel.");
                // if unsuccessful, then redirect back to the login with the form data
            }
        }

        //return redirect()->back()->withInput($request->only('email', 'remember'));


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function employeelogin(Request $request)
    {

        //echo "<pre>";
        //print_r($request->all());die;

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        $remember_me = $request->has('remember') ? true : false;

        // Attempt to log the user in
        $users = Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,
                'status' => 1,
                'gst_no' => null,

            ],
            $remember_me
        );


        // dd([
        //     'auth attempt'=>$users,
        //     'auth user'=>Auth::user(),
        // ]);
        //echo Auth::user()->first_name;die;

        if (!$users) {
            Session::flash('error', "You have entered the wrong credentials.");
            return back();
        } else {
            Session::put('role', "EMPLOYEE");

            Session::put('LoggedUser.user_id', Auth::user()->id);
            Session::put('LoggedUser.email_address', Auth::user()->email);
            Session::put('LoggedUser.first_name', Auth::user()->first_name);
            Session::put('LoggedUser.last_name', Auth::user()->last_name);
            Session::put('LoggedUser.designation', Auth::user()->designation);
            Session::put('LoggedUser.image', Auth::user()->image);
            $res = $this->getUsersRolesPermissions(Session::get('LoggedUser.user_id'));

            Session::put('LoggedUser.allowedPasgeList', $res[0]);
            Session::put('LoggedUser.allowedPageCodeList', $res[1]); /* index of array is pageid */
            Session::put('LoggedUser.allowedPageActions', $res[2]);
            Session::put('LoggedUser.userRoleIDs', $res[3]);

            return redirect()->intended(route('employee-portal.home'));
        }

        //return redirect()->back()->withInput($request->only('email', 'remember'));


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    function getUsersRolesPermissions($userID)
    {
        $res = DB::table('ur.id,rp.*')
            ->from('users as ur')
            //            ->join('roles_permissions as rp', 'ur.id', '=', 'rp.role_id')
            ->join('roles_permissions as rp', 'ur.role_id', '=', 'rp.role_id')
            ->where('ur.id', $userID)->get();

        $rowCount = count($res);
        $allowedPageActions = [];
        $userPageList = [];
        $userRoleID = [];
        $userPageCodeList = [];
        for ($i = 0; $i < $rowCount; $i++) {
            $userPageList[] = $res[$i]->page_id;
            $userRoleID[] = $res[$i]->role_id;
            $userPageCodeList[] = $res[$i]->page_code;

            $allowedPageActions[$res[$i]->role_id][$res[$i]->page_code] = $res[$i]->allowed;
        }
        /* set allowed pages array */
        $pageLists = [];
        foreach ($allowedPageActions as $pages) {
            foreach ($pages as $page => $val) {
                if ($val == 'Y') {
                    $pageLists[] = $page;
                }
            }
        }
        $userPageList = array_unique($userPageList);
        //$userPageCodeList = array_unique($userPageCodeList);
        $userPageCodeList = $pageLists;
        $userRoleID = array_unique($userRoleID);
        return array($userPageList, $userPageCodeList, $allowedPageActions, $userRoleID);
    }
}
