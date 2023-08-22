<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\Tender;
use Session;
use Auth; 
class TenderController extends Controller
{
   
    public function index()
    {   
        $tenders = Tender::orderBy('id','DESC');
        if(isset($request->name))
		{
            $tenders = $tenders->where('name','LIKE','%'.$request->name.'%');
        }
        $tenders = $tenders->paginate(10);
        return view('Admins.tender_management.index',compact('tenders'))->with('i', 1);
    }

    public function create()
    {
        return view('Admins.tender_management.create');
    
    }

    public function store(Request $request)
    {
        $tenders = new Tender();
        $tenders->name = $request->name;
        $tenders->name_ar = $request->name_ar;
		$tenders->publishing_date = $request->publishing_date;
		$tenders->closing_date = $request->closing_date;
		$tenders->description = $request->description;
		$tenders->description_ar = $request->description_ar;
		$tenders->created_by =Auth::user()->id;
		if($request->hasFile('upload_file'))
		{
            $upload_file=$request->file('upload_file');
            $new_name = rand(1000,9999).'.'.$upload_file->getClientOriginalExtension();
            $upload_file-> move(public_path('uploads/tender'),$new_name);
            $tenders->upload_file = $new_name;
        }  
        if($tenders->save())
		{
        
			 Session::flash('message', 'Tender has been added successfully');
			 return redirect()->route('tender.index'); 
		}
		else
		{
			Session::flash('error', 'Tender not added successfully');
			return redirect()->route('tender.index'); 
		} 
    }

   
    public function edit($id)
    {
         $tender = Tender::find($id);
         return view('Admins.tender_management.edit',compact('tender'));
    }

    public function update(Request $request, $id)
    {
        $tenders = Tender::where('id',$id)->first();
        
        $tenders->name = $request->name;
        $tenders->name_ar = $request->name_ar;
		$tenders->publishing_date = $request->publishing_date;
		$tenders->closing_date = $request->closing_date;
		$tenders->description = $request->description;
		$tenders->description_ar = $request->description_ar;
		$tenders->updated_by = Auth::user()->id;
		if($request->hasFile('upload_file'))
		{
            $upload_file=$request->file('upload_file');
            $new_name = rand(1000,9999).'.'.$upload_file->getClientOriginalExtension();
            $upload_file-> move(public_path('uploads/tender'),$new_name);
            $tenders->upload_file = $new_name;
        }  
        if($tenders->save())
		{
        
			 Session::flash('message', 'Tender has been updated successfully');
			 return redirect()->route('tender.index');
		}
		else
		{
			Session::flash('error', 'Tender not updated successfully');
			return redirect()->route('tender.index');
		}
    }
	
	public function status($id)
    {
        $tenders = Tender::where('id', $id)->first();

        if ($tenders->status == 1)
        {
            $tenders->status = 0; //0 for Block
            $tenders->save();

        }
        else 
		{
			$tenders->status = 1; //1 for Unblock
			$tenders->save();
		}

        if ($tenders->status == 1)
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
        $tenders = Tender::find($id);
        $tenders->delete();
       return redirect()->route('tender.index');
       
    }
}
