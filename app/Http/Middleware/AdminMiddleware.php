<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class AdminMiddleware
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
        if (!Auth::check()) {
        //    dd("admin auth");
            return $next($request);

        } else {
            return redirect('/home');
        }
    }
}
