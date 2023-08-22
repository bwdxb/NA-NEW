<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\DocumentLibrary;
use App\DocumentClassification;
use App\Menu;
use Session;
use Auth; 

use app\Http\helper\Helper as Helper;

class DocumentLibraryClassificationController extends Controller
{
   
    public function index(Request $request)
    { 
        $data= DocumentClassification::latest()->paginate();
	    return view('Admins.document_library.classification.index',compact('data'))->with('i', 1);
    }
    public function show(Request $request)
    { 
        $data= DocumentClassification::latest()->paginate();
	    return view('Admins.document_library.classification.index',compact('data'))->with('i', 1);
    }

    public function create()
    {
		
        return view('Admins.document_library.classification.create');
    
    }

    public function store(Request $request)
    {
        $document = new DocumentClassification();
		$document->classification = $request->classification;
		$document->created_by =Auth::user()->id;
        
        if($document->save())
		{
        
			 Session::flash('message', 'Document classification has been added successfully');
			  return redirect()->route('document_library_classification.index'); 
		}
		else
		{
			Session::flash('error', 'Document classification not added successfully');
			  return redirect()->route('document_library_classification.index'); 
		}

       
    }
   
    public function edit($id)
    {
         $data = DocumentClassification::find($id);
        
        return view('Admins.document_library.classification.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $document = DocumentClassification::find($id);
        $document->classification = $request->classification;
		$document->updated_by =Auth::user()->id;
       

        if($page->save())
		{
			 Session::flash('message', 'Document classification has been updated successfully');
			 return redirect()->route('document_library_classification.index');
		}
		else
		{
			Session::flash('error', 'Document classification not updated successfully');
			  return redirect()->route('document_library_classification.index');
		}
       
     
    }
	
	public function status($id)
    {
        $document = DocumentClassification::find($id);

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
        $document = DocumentClassification::find($id);
        $document->delete();
       return redirect()->route('document_library_classification.index');
       
    }	
   
}