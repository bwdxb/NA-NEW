<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\StoryCategory;
use App\Menu;
use Session;
use Auth; 
use Log;

use app\Http\helper\Helper as Helper;

class StoryCategoryController extends Controller
{
   
    public function index(Request $request)
    { 
        $data= StoryCategory::latest()->paginate();
	    return view('Admins.story_category.index',compact('data'))->with('i', 1);
    }
    public function show(Request $request)
    { 
        $data= StoryCategory::latest()->paginate();
	    return view('Admins.story_category.index',compact('data'))->with('i', 1);
    }

    public function create()
    {
		
        return view('Admins.story_category.create');
    
    }

    public function store(Request $request)
    {
        $document = new StoryCategory();
		$document->category = $request->category;
		$document->created_by =Auth::user()->id;
        
        if($document->save())
		{
        
			 Session::flash('message', 'Document category has been added successfully');
			  return redirect()->route('story_category.index'); 
		}
		else
		{
			Session::flash('error', 'Document category not added successfully');
			  return redirect()->route('story_category.index'); 
		}

       
    }
   
    public function edit($id)
    {
         $data = StoryCategory::find($id);
        
        return view('Admins.story_category.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $document = StoryCategory::find($id);
        $document->category = $request->category;
		$document->updated_by =Auth::user()->id;
       

        if($page->save())
		{
			 Session::flash('message', 'Document category has been updated successfully');
			 return redirect()->route('story_category.index');
		}
		else
		{
			Session::flash('error', 'Document category not updated successfully');
			  return redirect()->route('story_category.index');
		}
       
     
    }
	
	public function status($id)
    {
        $document = StoryCategory::find($id);

        if ($document->status == 1)
        {
            $document->status = 0; //0 for Block
            $document->updated_by = Auth::user()->id; //0 for Block
            $document->save();

        }
        else 
		{
			$document->status = 1; //1 for Unblock
            $document->updated_by = Auth::user()->id; //0 for Block
			$document->save();
		}

        if ($document->status == 1)
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
        $document = StoryCategory::find($id);
        $document->delete();
       return redirect()->route('story_category.index');
       
    }	
   
}