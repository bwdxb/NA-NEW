<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\VideoCategory;
use App\VideoGallery;
use App\VideoGalleryVersion;
use Session;
use Auth; 

use app\Http\helper\Helper as Helper;

class VideoGalleryController extends Controller
{
   
    public function index(Request $request)
    {
	
		Helper::checkUserSession();
		Helper::checkPagePermission('VW_CMS','view',session('userRoleIDs')); 
		 $video_categorys = VideoCategory::pluck('name','id');
		$video_category = VideoCategory::all();
		$video_gallery = DB::table('video_gallery')->leftjoin('video_category', 'video_gallery.cat_id', '=', 'video_category.id');
									
		if(isset($request->cat_id))
		 {
			//$video_gallery = $video_gallery->where('video_gallery.cat_id', '=', $request->cat_id);
            $video_gallery = $video_gallery->whereRaw('FIND_IN_SET("'.$request->cat_id.'",video_gallery.cat_id)');
		 }
         
         if(isset($request->title))
		 {
			$video_gallery = $video_gallery->where('video_gallery.title','LIKE','%'.$request->title.'%');
		 }
		
         if(isset($request->lang))
		 {
			$video_gallery = $video_gallery->where('video_gallery.lang','LIKE','%'.$request->lang.'%');
		 }
		
		
        $video_gallery = $video_gallery->select('video_category.name as category', 'video_gallery.*')->orderByDesc('video_date')->Paginate(10);
		
        return view('Admins.video_gallery_management.index',compact('video_gallery', 'video_category','video_categorys'))->with('i', 1);
    }

    public function create()
    {
		Helper::checkUserSession();
		Helper::checkPagePermission('CR_CMS','view',session('userRoleIDs')); 
		// $video_category = VideoCategory::pluck('name','name_ar','id');
		$video_category = VideoCategory::all();
		
        return view('Admins.video_gallery_management.create',compact('video_category'));
    
    }

    public function store(Request $request)
    {
        $video_gallery = new VideoGallery();
		$video_gallery->lang = $request->lang;
		$video_gallery->cat_id = implode(',', $request->cat_id);
        $video_gallery->title = $request->title;
        $video_gallery->title_ar = $request->title_ar;
		$video_gallery->video_date = $request->video_date;
        $video_gallery->youtube_link =$request->youtube_link;
        $video_gallery->youtube_link_ar =$request->youtube_link_ar;
		$video_gallery->created_by =Auth::user()->id;
		  
        if($video_gallery->save())
		{
        
			 Session::flash('message', 'Video Gallery has been added successfully');
			  return redirect()->route('video_gallery.index'); 
		}
		else
		{
			Session::flash('error', 'Video Gallery not added successfully');
			  return redirect()->route('video_gallery.index'); 
		}

       
    }

   
    public function edit($id)
    {
         $video_gallery = VideoGallery::find($id);
        // $video_category = VideoCategory::pluck('name','id');
        $video_category = VideoCategory::all();
        $video_gallery->cat_id = explode(',',$video_gallery->cat_id);
        return view('Admins.video_gallery_management.edit',compact('video_gallery','video_category'));
    }

    public function update(Request $request, $id)
    {
        $oldPage = VideoGallery::find($id);
        $video_gallery = VideoGallery::find($id);
        $video_gallery->lang = $request->lang;
        $video_gallery->cat_id = implode(',', $request->cat_id);
        $video_gallery->title = $request->title;
        $video_gallery->title_ar = $request->title_ar;
		$video_gallery->video_date = $request->video_date;
        $video_gallery->youtube_link =$request->youtube_link;
        $video_gallery->youtube_link_ar =$request->youtube_link_ar;
		$video_gallery->updated_by =Auth::user()->id;
		if($video_gallery->isDirty()){
        if($video_gallery->save())
		{
            $tempPageData= $oldPage->toArray();
            $tempPageData['video_gallery_id']=$tempPageData['id'];
            $tempPageData['created_by']=Auth::user()->id;
            unset($tempPageData['id']);
            unset($tempPageData['created_at']);
            $vcData= new VideoGalleryVersion($tempPageData);
            $vcData->save();
            
			 Session::flash('message', 'Video Gallery has been updated successfully');
			 return redirect()->route('video_gallery.index');
		}
		else
		{
			Session::flash('error', 'Video Gallery not updated successfully');
			  return redirect()->route('video_gallery.index');
		}
    }else{
        return redirect()->route('video_gallery.index');
       }
     
    }
	
	public function status($id)
    {
        $video_gallery = VideoGallery::where('id', $id)->first();

        if ($video_gallery->status == 1)
        {
            $video_gallery->status = 0; //0 for Block
            $video_gallery->save();

        }
        else 
		{
			$video_gallery->status = 1; //1 for Unblock
			$video_gallery->save();
		}

        if ($video_gallery->status == 1)
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
       
        $video_gallery=VideoGallery::find($id);
        $video_gallery->delete();
       return redirect()->route('video_gallery.index');
       
    }
	
	public function pageRevert(Request $request,$id)
	{
        try{
            $revertPageData =  VideoGalleryVersion::where('id',$id)->first();
            $oldPage = VideoGallery::find($revertPageData->video_gallery_id);
            $page = VideoGallery::find($revertPageData->video_gallery_id);
            $page->lang = $revertPageData->lang;
            $page->cat_id = $revertPageData->cat_id;
            $page->title = $revertPageData->title;
            $page->title_ar = $revertPageData->title_ar;
            $page->video_date = $revertPageData->video_date;
            $page->youtube_link =$revertPageData->youtube_link;
            $page->youtube_link_ar =$revertPageData->youtube_link_ar;
            $page->updated_by =Auth::user()->id;
            
          
			  if($page->isDirty()){
                if($page->save())
                {
                    $tempPageData= $oldPage->toArray();
                    $tempPageData['video_gallery_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    $vcData= new VideoGalleryVersion($tempPageData+['reverted'=>1]);
                    $vcData->save();                
                    Session::flash('success', 'Page has been reverted successfully');
                }else{
                    Session::flash('error', 'Page not updated successfully');
                }
           
        }
           
        }catch(Exception $ex){
            Log::error($ex);
            Session::flash('error', 'internal server error');
        }
        return redirect()->route('video_gallery.index');

    }

    public static function getCategory($cat_id)
    {
        $video_categories = VideoCategory::pluck('name','id');
        $explode = explode(',',$cat_id);
        $category = array();
        if(!empty($explode))
        {            
            foreach ($explode as $key => $value){

                if($video_categories[$value]){

                    $category[] = $video_categories[$value];
                }
            }
        }
        
        return implode(',',$category);
    }

    public function history($id)
    {
        try {
            //code...
            $video_gallery  = VideoGalleryVersion::where('video_gallery_id',$id)->orderBy('id','DESC');
            $video_gallery  = $video_gallery ->paginate(10);
            return view('Admins.video_gallery_management.history',compact('video_gallery'))->with('i',1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect()->route('video_gallery.index');
        }
        
    }
}
