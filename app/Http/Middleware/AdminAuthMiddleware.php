<?php

namespace App\Http\Middleware;

use Closure, Auth;
use Session;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tempurl=\Request::getRequestUri();
        
        if (!Auth::check()) {
            return redirect('/login');
        }else{
            
            if(Session::get('role')=='EMPLOYEE'){
                return redirect('/employee-portal/home');
            }
           if(Auth::user()->role_id ==3){
            // Session::flash("error","Unauthorized route");
            return redirect('/employee-portal/home');
           }
        }
        

        return $next($request);
    }
}
