<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use Image;

class OptimizeImage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $ttl=10)
    {
    //   dd($request->file);
    //   if($media_type=='image'){
    //     $img = Image::make($file->path());
    //     // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
    //     // $img->resize(450, 350, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
    //     $file_url='public/uploads/story/' . $file_name;
    //     $img->save($file_url, 75);
    // }else{

    // }
        return $next($request);
    }
}