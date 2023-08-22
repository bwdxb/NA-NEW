<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\NewsCategory;
use Session;
use Auth; 
class NewsCategoryController extends Controller
{
   
    public function index()
    {   
        $news_category = NewsCategory::orderBy('id','DESC');
        
        $news_category = $news_category->paginate(10);
        return view('Admins.news_category_management.index',compact('news_category'))->with('i', 1);
    }

    public function create()
    {
        return view('Admins.news_category_management.create');
    
    }

    public function store(Request $request)
    {
        $news_category = new NewsCategory();
        $news_category->name = $request->name;
        $news_category->name_ar = $request->name_ar;
		$news_category->created_by =Auth::user()->id;
		 
        if($news_category->save())
		{
        
			 Session::flash('message', 'News Category has been added successfully');
			 return redirect()->route('news_category.index'); 
		}
		else
		{
			Session::flash('error', 'News Category not added successfully');
			return redirect()->route('news_category.index'); 
		} 
    }

   
    public function edit($id)
    {
         $news_category = NewsCategory::find($id);
         return view('Admins.news_category_management.edit',compact('news_category'));
    }

    public function update(Request $request, $id)
    {
	
        $news_category = NewsCategory::where('id',$id)->first();
        $news_category->name = $request->name;
        $news_category->name_ar = $request->name_ar;
		$news_category->updated_by = Auth::user()->id;
		    
        if($news_category->save())
		{
        
			 Session::flash('message', 'News Category has been updated successfully');
			 return redirect()->route('news_category.index');
		}
		else
		{
			Session::flash('error', 'News Category not updated successfully');
			return redirect()->route('news_category.index');
		}
    }
	
	public function status($id)
    {
        $news_category = NewsCategory::where('id', $id)->first();

        if ($news_category->status == 1)
        {
            $news_category->status = 0; //0 for Block
            $news_category->save();

        }
        else 
		{
			$news_category->status = 1; //1 for Unblock
			$news_category->save();
		}

        if ($news_category->status == 1)
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
        $news_category = NewsCategory::find($id);
        $news_category->delete();
       return redirect()->route('news_category.index');
       
    }
}
