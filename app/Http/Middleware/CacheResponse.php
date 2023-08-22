<?php

namespace App\Http\Middleware;

use Closure;
use Cache;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $ttl=600)
    {
       if(auth()->user() != null || $request->isMethod('post')){
            return $next($request);
        }
        $params = $request->query(); unset($params['_method']); ksort($params);
        $key = md5(url()->current().'?'.http_build_query($params));
        if($request->get('_method')=='purge'){
            Cache::forget($key);
        }

        if($request->get('_method')=='purge_all'){
            Cache::flush();
        }else{
            if(Cache::has($key)){
                $cache = Cache::get($key);
                $response = response($cache['content']);
                $response->header('X-Proxy-Cache', 'HIT');
            }else {
                $response = $next($request);
                if(!empty($response->content())){
                    Cache::put($key,['content' => $response->content()],$ttl);
                }
                $response->header('X-Proxy-Cache', 'MISS');
                $response->header('X-No-Session', 'yeah');
            }
            return $response;
        }
        return $next($request);
    }
}