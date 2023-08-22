<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdministratorAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect('/login');
//            return redirect()->route('login');
        }

        $user = Auth::user();
        if (!$user) {
//            return back()->with('error', 'Login First !!!');
            return redirect('/login')->with('error', 'Login First !!!');
        }
        // dd(Session::get('role'));
if(Session::get('role')=='EMPLOYEE'){
    return redirect('/employee-portal/home');
}
        if (in_array($user->role_id, [1, 2])) {
            // dd('admin auth');
            return $next($request);
        }

//        return back()->with('error', 'Access Denied !!!');
        return redirect('/login')->with('error', 'Access Denied !!!');

    }
}
