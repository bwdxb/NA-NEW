<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\DocumentLibrary;
use App\DocumentType;
use App\Menu;
use Session;
use Auth; 

use app\Http\helper\Helper as Helper;

class DocumentLibraryTypeController extends Controller
{
   
    public function index(Request $request)
    { 
        $data= DocumentType::latest()->paginate();
	    return view('Admins.document_library.type.index',compact('data'))->with('i', 1);
    }
    public function show(Request $request)
    { 
        $data= DocumentType::latest()->paginate();
	    return view('Admins.document_library.type.index',compact('data'))->with('i', 1);
    }

    public function create()
    {
		
        return view('Admins.document_library.type.create');
    
    }

    public function store(Request $request)
    {
        $document = new DocumentType();
		$document->type = $request->type;
		$document->created_by =Auth::user()->id;
        
        if($document->save())
		{
        
			 Session::flash('message', 'Document type has been added successfully');
			  return redirect()->route('document_library_type.index'); 
		}
		else
		{
			Session::flash('error', 'Document type not added successfully');
			  return redirect()->route('document_library_type.index'); 
		}

       
    }
   
    public function edit($id)
    {
         $data = DocumentType::find($id);
        
        return view('Admins.document_library.type.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $document = DocumentType::find($id);
        $document->type = $request->type;
		$document->updated_by =Auth::user()->id;
       

        if($page->save())
		{
			 Session::flash('message', 'Document type has been updated successfully');
			 return redirect()->route('document_library_type.index');
		}
		else
		{
			Session::flash('error', 'Document type not updated successfully');
			  return redirect()->route('document_library_type.index');
		}
       
     
    }
	
	public function status($id)
    {
        $document = DocumentType::find($id);

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
        $document = DocumentType::find($id);
        $document->delete();
       return redirect()->route('document_library_type.index');
       
    }	
   
}