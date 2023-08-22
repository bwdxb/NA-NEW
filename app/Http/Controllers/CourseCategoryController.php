<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\CourseCategory;
use Session;
use Auth; 
class CourseCategoryController extends Controller
{
   
    public function index(Request $request)
    {   
        $courses = CourseCategory::query();
        if ($request->search_key) {
            $courses = $courses->where('title', 'LIKE', trim($request->search_key).'%');
        }
        if ($request->category) {
            $courses = $courses->where('category', $request->category);
        }
        switch ($request->sort) {
            case 'Newest':
                $courses = $courses->latest();
                break;
            case 'Oldest':
                $courses = $courses->oldest();
                break;
            default:
                $courses = $courses->latest();
        }
        
        $courses = $courses->paginate(10);
        // dd($course_category);
        return view('Admins.category_course_management.index',compact('courses'))->with('i', 1);
    }

    public function create()
    {
        return view('Admins.category_course_management.create');
    
    }

    public function store(Request $request)
    {

        $course = new CourseCategory();
        $course->category = $request->category;
        $course->title = $request->title;
        // $course->title_ar = $request->title_ar;
        $course->status = 1;
		$course->created_by =Auth::user()->id;
		 
        if($course->save())
		{
        
			 Session::flash('message', 'Category Course has been added successfully');
			 return redirect()->route('course_category.index'); 
		}
		else
		{
			Session::flash('error', 'Category Course not added successfully');
			return redirect()->route('course_category.index'); 
		} 
    }

   
    public function edit($id)
    {
         $course = CourseCategory::find($id);
         return view('Admins.category_course_management.edit',compact('course'));
    }
    public function duplicate($id)
    {
         $course = CourseCategory::find($id);
         return view('Admins.category_course_management.duplicate',compact('course'));
    }

    public function update(Request $request, $id)
    {
	
        $course = CourseCategory::where('id',$id)->first();
         $course->category = $request->category;
         $course->title = $request->title;
        // $course->title_ar = $request->title_ar;
      
		$course->updated_by = Auth::user()->id;
		    
        if($course->save())
		{
        
			 Session::flash('message', 'Category Course has been updated successfully');
			 return redirect()->route('course_category.index');
		}
		else
		{
			Session::flash('error', 'Category Course not updated successfully');
			return redirect()->route('course_category.index');
		}
    }
	
	public function status($id)
    {
        $course = CourseCategory::where('id', $id)->first();

        if ($course->status == 1)
        {
            $course->status = 0; //0 for Block
            $course->save();

        }
        else 
		{
			$course->status = 1; //1 for Unblock
			$course->save();
		}

        if ($course->status == 1)
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
        $course = CourseCategory::find($id);
        $course->delete();
       return redirect()->route('course_category.index');
       
    }
}
