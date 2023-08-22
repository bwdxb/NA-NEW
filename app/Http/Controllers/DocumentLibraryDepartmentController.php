<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\DocumentLibrary;
use App\DocumentDepartment;
use App\Menu;
use Session;
use Auth; 

use app\Http\helper\Helper as Helper;

class DocumentLibraryDepartmentController extends Controller
{
   
    public function index(Request $request)
    { 
        $data= DocumentDepartment::latest()->paginate();
	    return view('Admins.document_library.department.index',compact('data'))->with('i', 1);
    }
    public function show(Request $request)
    { 
        $data= DocumentDepartment::latest()->paginate();
	    return view('Admins.document_library.department.index',compact('data'))->with('i', 1);
    }

    public function create()
    {
		
        return view('Admins.document_library.department.create');
    
    }

    public function store(Request $request)
    {
        $document = new DocumentDepartment();
		$document->department = $request->department;
		$document->created_by =Auth::user()->id;
        
        if($document->save())
		{
        
			 Session::flash('message', 'Document department has been added successfully');
			  return redirect()->route('document_library_department.index'); 
		}
		else
		{
			Session::flash('error', 'Document department not added successfully');
			  return redirect()->route('document_library_department.index'); 
		}

       
    }
   
    public function edit($id)
    {
         $data = DocumentDepartment::find($id);
        
        return view('Admins.document_library.department.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $document = DocumentDepartment::find($id);
        $document->department = $request->department;
		$document->updated_by =Auth::user()->id;
       

        if($document->save())
		{
			 Session::flash('message', 'Document department has been updated successfully');
			 return redirect()->route('document_library_department.index');
		}
		else
		{
			Session::flash('error', 'Document department not updated successfully');
			  return redirect()->route('document_library_department.index');
		}
    }
	
	public function status($id)
    {
        $document = DocumentDepartment::find($id);

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
        $document = DocumentDepartment::find($id);
        $document->delete();
       return redirect()->route('document_library_department.index');
       
    }	
   
}