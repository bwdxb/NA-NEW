<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use Auth;
use App\AdminUser; 
use App\Role;
use App\Banner; 
use DB; 
use Session; 
use app\Http\helper\Helper as Helper;


class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::orderBy('id','desc');
        
        
        if(isset($request->banner_name))
		{
              $banners = $banners->where('name','LIKE','%'.$request->banner_name.'%');
        }
		
        $banners = $banners->paginate(10);
        return view('Admins.banner_management.index',compact('banners'));
    }

    
    public function create() 
	{
        return view('Admins.banner_management.create');
    }

    public function store(Request $request) 
	{
        $banner = new Banner();
        $banner->name = $request->name;
		$banner->file_type = $request->file_type;
		$banner->sequence_number = $request->sequence_number;
      	$banner->created_by =Auth::user()->id;
        // if($request->hasFile('image')) 
		// {
        //    $image=$request->file('image');
        //    $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
        //    $image-> move(public_path('uploads/banner'),$new_name);
        //    $banner->image = $new_name;
        // }
        // if($request->hasFile('image_mob')) 
		// {
        //    $image=$request->file('image_mob');
        //    $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
        //    $image-> move(public_path('uploads/banner'),$new_name);
        //    $banner->image_mob = $new_name;
        // }
           $banner->image = $request->image;
           $banner->image_mob = $request->image_mob;
           $banner->save();
        Session::flash('message', 'Banner has been added successfully');
        return redirect()->route('banner.index');
    }

   
    public function show($id)
    {
        $banner = Banner::where('id',$id)->first();

        return view('Admins.banner_management.view',compact('banner'));
    }

    public function edit($id)
    {
		 $banner = Banner::where('id',$id)->first();
        return view('Admins.banner_management.edit',compact('banner'));
    }

   
    public function update(Request $request, $id)
    {
        
        $banner = Banner::where('id',$id)->first();
		$banner->name = $request->name;
        $banner->sequence_number = $request->sequence_number;
		$banner->file_type = $request->file_type;
		$banner->updated_by =Auth::user()->id;
        // http://na.bw.ae/public/uploads/banner/2652.mp4
        // if($request->hasFile('image'))
		// {
        //     $image=$request->file('image');
        //     $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
        //     $image-> move(public_path('uploads/banner'),$new_name);
        //     $banner->image = $new_name;
        // }   
        // if($request->hasFile('image_mob')) 
		// {
        //    $image=$request->file('image_mob');
        //    $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
        //    $image-> move(public_path('uploads/banner'),$new_name);
        //    $banner->image_mob = $new_name;
        // }     
            $banner->image = $request->image;
           $banner->image_mob = $request->image_mob;
        $banner->save();
        Session::flash('message', 'Banner has been updated successfully');
         return redirect()->route('banner.index');
    }
	public function status($id)
    {

        $banner = Banner::where('id', $id)->first();

        if ($banner->status == 1)
        {
            $banner->status = 0; //0 for Block
            $banner->save();

        }else{ $banner->status = 1; //1 for Unblock
        $banner->save();
        }
        if ($banner->status == 1)
        {
            Session::flash('success', 'status changed successfully');

            return redirect()->route('banner.index');
        }
        else
        {
            Session::flash('success', 'status changed successfully');

            return redirect()->route('banner.index');
        }

    }
   
    public function delete($id)
    {
        $banner=Banner::find($id);
        $banner->delete();
        Session::flash('success', 'deleted successfully');

       return redirect()->route('banner.index');
    }

    public function validateBanner(Request $request)
    {

      $banner = Banner::where('name', $request->name)->first();
      if($banner)
      {
        return 0;
      }
        return 1;
      

    }

    public function validateBannerEdit(Request $request)
    {
     
        $banner = Banner::where('name',$request->name)->where('id','!=',$request->id)->first();
        
        if($banner){
            return 0;
        }
        
        return 1;
    }
}

