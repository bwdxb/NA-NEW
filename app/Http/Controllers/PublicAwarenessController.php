<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use Auth;
use App\AdminUser; 
use App\Role;
use App\PublicAwareness; 
use DB; 
use Session; 
use app\Http\helper\Helper as Helper;


class PublicAwarenessController extends Controller
{

    public function fetch_cms(Request $request)
    {
        // $data=PublicAwareness::query();
        $data=PublicAwareness::where('status',1);

        if(isset($request->search)){
            if(app()->getLocale() == 'en'){
                $data=$data->where('name','LIKE',$request->search.'%');
            }else{
                $data=$data->where('name_ar','LIKE',$request->search.'%');
            }
        }
        if($request->sort=='oldest'){
            $data=$data->oldest();
        }else{
            $data=$data->latest();
        }
        $data=$data->get();
        return view('website.public_awareness',compact('data'));
    }

    public function fetch_details($id)
    {
        $data=PublicAwareness::find($id);
        if(!$data || !$data->status){
            Session::flash('error',"404:Invalid data or url.");
            return redirect()->route('public_awareness.index');
        }
        // dd($data->faq);
        return view('website.public_awareness_details',compact('data'));
    }
    public function index(Request $request)
    {
        $banners = PublicAwareness::orderBy('id','desc');
        
        
        if(isset($request->banner_name))
		{
              $banners = $banners->where('name','LIKE','%'.$request->banner_name.'%');
        }
		
        $banners = $banners->paginate(10);
        return view('Admins.public_awareness_management.index',compact('banners'));
    }

    
    public function create() 
	{
		$categories = DB::table('public_awareness_category')->where('status',1)->pluck('name', 'id');
        return view('Admins.public_awareness_management.create',compact('categories'));
    }

    public function store(Request $request) 
	{
        $banner = new PublicAwareness();
        $banner->name = $request->name;
        $banner->name_ar = $request->name_ar;
		$banner->objective = $request->objective;
		$banner->objective_ar = $request->objective_ar;
		$banner->description = $request->description;
		$banner->description_ar = $request->description_ar;
      	$banner->created_by =Auth::user()->id;
        if($request->hasFile('image')) 
		{
           $image=$request->file('image');
           $new_name = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->image = $new_name;
        }

        if($request->hasFile('image_ar')) 
        {
           $image=$request->file('image_ar');
           $new_name = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->image_ar = $new_name;
        }
		
		if($request->hasFile('graphics'))
        {
            foreach($request->graphics as $graphics)
            { 
                
                $new_name = time().'-'.rand(1000,9999).'.'.$graphics->getClientOriginalExtension();
                $graphics->move(public_path('uploads/public_awareness'),$new_name);
                $graphicsDataUrl[] = $new_name;  
            }
			
			 $banner->graphics=json_encode($graphicsDataUrl);
        }
		if($request->video)
        {
            foreach($request->video as $video)
            { 
                $data[] = $video;  
            }
			unset($data[count($data)-1]);
			 $banner->videos=json_encode($data);
        }
		// if($request->video_type)
        // {
        //     foreach($request->video_type as $video_type)
        //     { 
        //         $videoTypedata[] = $video_type;  
        //     }
		// 	unset($videoTypedata[count($videoTypedata)-1]);
		// 	 $banner->video_type=json_encode($videoTypedata);
        // }

		if($request->hasFile('poster')) 
		{
           $image=$request->file('poster');
           $new_name = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->poster = $new_name;
        }
        if($request->hasFile('poster_ar')) 
        {
           $image=$request->file('poster_ar');
           $new_name = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->poster_ar = $new_name;
        }
           $banner->save();
        Session::flash('message', 'Banner has been added successfully');
        return redirect()->route('public_awareness.index');
    }

   
    
    public function edit($id)
    {
		 $banner = PublicAwareness::where('id',$id)->first();
		 $categories = DB::table('public_awareness_category')->where('status',1)->pluck('name', 'id');
        return view('Admins.public_awareness_management.edit',compact('banner','categories'));
    }

   
    public function update(Request $request, $id)
    {
        // dd($request->all);
        $banner = PublicAwareness::where('id',$id)->first();
		$banner->name = $request->name;
		$banner->name_ar = $request->name_ar;
		$banner->objective = $request->objective;
		$banner->objective_ar = $request->objective_ar;
		$banner->description = $request->description;
		$banner->description_ar = $request->description_ar;
      	$banner->created_by =Auth::user()->id;
        if($request->hasFile('image')) 
		{
           $image=$request->file('image');
           $new_name =  time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->image = $new_name;
        }
		if($request->hasFile('image_ar')) 
        {
           $image=$request->file('image_ar');
           $new_name =  time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->image_ar = $new_name;
        }
        $graphicsDataUrl=[];
		if($request->hasFile('graphics'))
        {
            foreach($request->graphics as $graphics)
            { 
                
                $new_name = time().'-'.rand(1000,9999).'.'. $graphics->getClientOriginalExtension();
                $graphics->move(public_path('uploads/public_awareness'),$new_name);
                $graphicsDataUrl[] = $new_name;  
            }
			
			 
        }
        if($request->graphics_images){
            foreach($request->graphics_images as $graphics_images)
            { 
                $graphicsDataUrl[] = $graphics_images;  
            }
        }
        if(!empty($graphicsDataUrl)){
            $banner->graphics=json_encode($graphicsDataUrl);
        }
		if($request->video)
         {
            foreach($request->video as $video)
            { 
                $data[] = $video;  
            }
			unset($data[count($data)-1]);
			 $banner->videos=json_encode($data);
         }
        //  if($request->video_type)
        //  {
        //      foreach($request->video_type as $video_type)
        //      { 
        //          $videoTypedata[] = $video_type;  
        //      }
        //      unset($videoTypedata[count($videoTypedata)-1]);
        //       $banner->video_type=json_encode($videoTypedata);
        //  }
		 if($request->hasFile('poster')) 
		{
           $image=$request->file('poster');
           $new_name = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->poster = $new_name;
        }

        if($request->hasFile('poster_ar')) 
        {
           $image=$request->file('poster_ar');
           $new_name = time().'-'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/public_awareness'),$new_name);
           $banner->poster_ar = $new_name;
        }
        $banner->save();
        Session::flash('message', 'Banner has been updated successfully');
         return redirect()->route('public_awareness.index');
    }
	public function status($id)
    {

        $banner = PublicAwareness::where('id', $id)->first();

        if ($banner->status == 1)
        {
            $banner->status = 0; //0 for Block
            $banner->save();

        }
        else $banner->status = 1; //1 for Unblock
        $banner->save();

        if ($banner->status == 1)
        {
            return 1;
        }
        else
        {
            return 2;
        }

    }
   
    public function delete($id)
    {
        $banner=PublicAwareness::find($id);
        $banner->delete();
       return redirect()->route('public_awareness.index');
    }

    public function validateBanner(Request $request)
    {
      $banner = PublicAwareness::where('name', $request->name)->first();
      if($banner)
      {
        return 0;
      }
        return 1;
    }

    public function validateBannerEdit(Request $request)
    {
     
        $banner = PublicAwareness::where('name',$request->name)->where('id','!=',$request->id)->first();
        
        if($banner){
            return 0;
        }
        
        return 1;
    }
	
	public function manage_awareness_faq($id)
	{
		$faqs = DB::table('public_awareness_faq')->where('awareness_id', $id)->paginate(10);
		
		return view('Admins.public_awareness_management.manage_awareness_faq',compact('faqs','id'));
	}
	
	public function add_awareness_faq($id)
	{
		return view('Admins.public_awareness_management.add_awareness_faq',compact('id'));
	}
	
	public function store_awareness_faq(Request $request,$id)
	{
	//echo "<pre>";
	//print_r($request->all());
	//die;
		for($i=0; $i<count($request->question)-1;$i++)
        { 
			DB::table('public_awareness_faq')->insert(array('awareness_id' => $request->awareness_id, 'question' => $request->question[$i], 'answer' => $request->answer[$i], 'question_ar' => $request->question_ar[$i], 'answer_ar' => $request->answer_ar[$i], 'created_by' => Auth::user()->id));
			Session::flash('message', 'FAQs added successfully');
		}

		return redirect('/admin/public_awareness/manage_awareness_faq/'.$request->awareness_id);
	}
	
	public function faq_edit($id)
    {
		 $faq = DB::table('public_awareness_faq')->where('id', $id)->get();
		 
        return view('Admins.public_awareness_management.faq_edit',compact('faq'));
    }
	
	public function update_awareness_faq(Request $request,$id)
	{
		$update = \DB::table('public_awareness_faq')->where('id', $request['id'])->update( [ 'question' => $request['question'], 'answer' => $request['answer'],'question_ar' => $request['question_ar'], 'answer_ar' => $request['answer_ar'], 'updated_by' => Auth::user()->id ]); 
		echo '<script type="text/javascript">'
			   , 'history.go(-2);'
			   , '</script>';
	}
	
	public function faq_status($id)
    {

        $faq = DB::table('public_awareness_faq')->where('id', $id)->first();
		

        if ($faq->status == 1)
        {
            $update = DB::table('public_awareness_faq')->where('id', $id)->update(array( 'status' => 0 )); //0 for Block
			 return 1;
            
        }
        else  $update = DB::table('public_awareness_faq')->where('id', $id)->update(array( 'status' => 1 )); //1 for Unblock
		 return 2;

    }
   
    public function faq_delete($id)
    {
        DB::table('public_awareness_faq')->where('id', $id)->delete();
       echo '<script type="text/javascript">'
			   , 'history.go(-2);'
			   , '</script>';
    }
}

