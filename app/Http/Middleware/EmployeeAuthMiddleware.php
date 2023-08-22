<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;
class EmployeeAuthMiddleware
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
if(Session::get('role')=='ADMIN'){
    // dd(Session::get('role'));
    return redirect('/login');
}
        // if ($user->role_id == 3) {
            return $next($request);
        // }

//        return back()->with('error', 'Access Denied !!!');
        return redirect('/login')->with('error', 'Access Denied !!!');

    }
}
