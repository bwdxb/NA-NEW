<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\Partner;
use Session;
use Auth; 
class PartnerController extends Controller
{
   
    public function index()
    {   
        $partners = Partner::orderBy('id','DESC');
        if(isset($request->search))
		{
            $partners = $partners->where('name','LIKE','%'.$request->search.'%');
        }
        $partners = $partners->paginate(10);
        return view('Admins.partner_management.index',compact('partners'))->with('i', 1);
    }

    public function create()
    {
        return view('Admins.partner_management.create');
    
    }

    public function store(Request $request)
    {
        $partner = new Partner();
        $partner->name = $request->name;
        $partner->name_ar = $request->name_ar;
		$partner->created_by =Auth::user()->id;
		if($request->hasFile('image'))
		{
            $image=$request->file('image');
            $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image-> move(public_path('uploads/partner'),$new_name);
            $partner->image = $new_name;
        }

        if($partner->save())
		{
			 Session::flash('message', 'Partner has been added successfully');
			 return redirect()->route('partner.index'); 
		}
		else
		{
			Session::flash('error', 'Parner not added successfully');
			return redirect()->route('partner.index'); 
		} 
    }

   
    public function edit($id)
    {
         $partner = Partner::find($id);
         return view('Admins.partner_management.edit',compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::where('id',$id)->first();
        
        $partner->name = $request->name;
        $partner->name_ar = $request->name_ar;
        
		$partner->updated_by = Auth::user()->id;
		if($request->hasFile('image'))
		{
            $image=$request->file('image');
            $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image-> move(public_path('uploads/partner'),$new_name);
            $partner->image = $new_name;
        }    
        if($partner->save())
		{
        
			 Session::flash('message', 'Partner has been updated successfully');
			 return redirect()->route('partner.index');
		}
		else
		{
			Session::flash('error', 'Partner not updated successfully');
			  return redirect()->route('partner.index');
		}
       
     
    }
	
	public function status($id)
    {
        $Partner = Partner::where('id', $id)->first();

        if ($partner->status == 1)
        {
            $partner->status = 0; //0 for Block
            $partner->save();

        }
        else 
		{
			$partner->status = 1; //1 for Unblock
			$partner->save();
		}

        if ($partner->status == 1)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }
	
	public function validatePartner(Request $request)
    {

      $partner = Partner::where('name', $request->name)->first();
      if($partner)
      {
        return 0;
      }
        return 1;
      

    }

    public function validatePartnerEdit(Request $request)
    {
     
        $partner = Partner::where('name',$request->name)->where('id','!=',$request->id)->first();
        
        if($partner){
            return 0;
        }
        
        return 1;
    }

    public function delete($id)
    {
       
        $partner=Partner::find($id);
        $partner->delete();
       return redirect()->route('partner.index');
       
    }
}
