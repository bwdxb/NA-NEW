<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\VideoCategory;
use Session;
use Auth; 
class VideoCategoryController extends Controller
{
   
    public function index()
    {   
        $video_category = VideoCategory::orderBy('id','DESC');
        
        $video_category = $video_category->paginate(10);
        return view('Admins.video_category_management.index',compact('video_category'))->with('i', 1);
    }

    public function create()
    {
        return view('Admins.video_category_management.create');
    
    }

    public function store(Request $request)
    {
        $video_category = new VideoCategory();
        $video_category->name = $request->name;
        $video_category->name_ar = $request->name_ar;
		$video_category->created_by =Auth::user()->id;
		 
        if($video_category->save())
		{
        
			 Session::flash('message', 'Video Category has been added successfully');
			 return redirect()->route('video_category.index'); 
		}
		else
		{
			Session::flash('error', 'Video Category not added successfully');
			return redirect()->route('video_category.index'); 
		} 
    }

   
    public function edit($id)
    {
         $video_category = VideoCategory::find($id);
         return view('Admins.video_category_management.edit',compact('video_category'));
    }

    public function update(Request $request, $id)
    {
	
        $video_category = VideoCategory::where('id',$id)->first();
        $video_category->name = $request->name;
        $video_category->name_ar = $request->name_ar;
		$video_category->updated_by = Auth::user()->id;
		    
        if($video_category->save())
		{
        
			 Session::flash('message', 'Video Category has been updated successfully');
			 return redirect()->route('video_category.index');
		}
		else
		{
			Session::flash('error', 'Video Category not updated successfully');
			return redirect()->route('video_category.index');
		}
    }
	
	public function status($id)
    {
        $video_category = VideoCategory::where('id', $id)->first();

        if ($video_category->status == 1)
        {
            $video_category->status = 0; //0 for Block
            $video_category->save();

        }
        else 
		{
			$video_category->status = 1; //1 for Unblock
			$video_category->save();
		}

        if ($video_category->status == 1)
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
        $video_category = VideoCategory::find($id);
        $video_category->delete();
       return redirect()->route('video_category.index');
       
    }
}
