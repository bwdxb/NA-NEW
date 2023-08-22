<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\PublicAwarenessCategory;
use App\Menu;
use Session;
use Auth; 

use app\Http\helper\Helper as Helper;

class PublicAwarenessCategoryController extends Controller
{
   
    public function index(Request $request)
    { 
        $data= PublicAwarenessCategory::latest()->paginate();
	    return view('Admins.public_awareness_management.category.index',compact('data'))->with('i', 1);
    }
    public function show(Request $request)
    { 
        $data= PublicAwarenessCategory::latest()->paginate();
	    return view('Admins.public_awareness_management.category.index',compact('data'))->with('i', 1);
    }

    public function create()
    {
		
        return view('Admins.public_awareness_management.category.create');
    
    }

    public function store(Request $request)
    {
        $document = new PublicAwarenessCategory();
		$document->name = $request->name;
		$document->name_ar = $request->name_ar;
		$document->created_by =Auth::user()->id;
        
        if($document->save())
		{
        
			 Session::flash('message', 'Public awareness category has been added successfully');
			  return redirect()->route('public_awareness_category.index'); 
		}
		else
		{
			Session::flash('error', 'Public awareness category not added successfully');
			  return redirect()->route('public_awareness_category.index'); 
		}

       
    }
   
    public function edit($id)
    {
         $data = PublicAwarenessCategory::find($id);
        
        return view('Admins.public_awareness_management.category.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $document = PublicAwarenessCategory::find($id);
        $document->name = $request->name;
        $document->name_ar = $request->name_ar;
		$document->updated_by =Auth::user()->id;
       

        if($document->save())
		{
			 Session::flash('message', 'Public awareness category has been updated successfully');
			 return redirect()->route('public_awareness_category.index');
		}
		else
		{
			Session::flash('error', 'Public awareness category not updated successfully');
			  return redirect()->route('public_awareness_category.index');
		}
       
     
    }
	
	public function status($id)
    {
        $document = PublicAwarenessCategory::find($id);

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
        $document = PublicAwarenessCategory::find($id);
        $document->delete();
       return redirect()->route('public_awareness_category.index');
       
    }	
   
}