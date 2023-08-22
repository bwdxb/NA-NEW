<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\OrganizationType;
use Session;
use Auth; 
class OrganizationTypeController extends Controller
{
   
    public function index()
    {   
        $organization_type = OrganizationType::orderBy('id','DESC');
        
        $organization_type = $organization_type->paginate(10);
        return view('Admins.organization_type_management.index',compact('organization_type'))->with('i', 1);
    }

    public function create()
    {
        return view('Admins.organization_type_management.create');
    
    }

    public function store(Request $request)
    {
        $organization_type = new OrganizationType();
        $organization_type->type = $request->type;
        $organization_type->type_ar = $request->type_ar;
		$organization_type->created_by =Auth::user()->id;
		 
        if($organization_type->save())
		{
        
			 Session::flash('message', 'Organization Type has been added successfully');
			 return redirect()->route('organization_type.index'); 
		}
		else
		{
			Session::flash('error', 'Organization Type not added successfully');
			return redirect()->route('organization_type.index'); 
		} 
    }

   
    public function edit($id)
    {
         $organization_type = OrganizationType::find($id);
         return view('Admins.organization_type_management.edit',compact('organization_type'));
    }

    public function update(Request $request, $id)
    {
	
        $organization_type = OrganizationType::where('id',$id)->first();
        $organization_type->type = $request->type;
        $organization_type->type_ar = $request->type_ar;
		$organization_type->updated_by = Auth::user()->id;
		    
        if($organization_type->save())
		{
        
			 Session::flash('message', 'Organization Type has been updated successfully');
			 return redirect()->route('organization_type.index');
		}
		else
		{
			Session::flash('error', 'Organization Type not updated successfully');
			return redirect()->route('organization_type.index');
		}
    }
	
	public function status($id)
    {
        $organization_type = OrganizationType::where('id', $id)->first();

        if ($organization_type->status == 1)
        {
            $organization_type->status = 0; //0 for Block
            $organization_type->save();

        }
        else 
		{
			$organization_type->status = 1; //1 for Unblock
			$organization_type->save();
		}

        if ($organization_type->status == 1)
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
        $organization_type = OrganizationType::find($id);
        $organization_type->delete();
       return redirect()->route('organization_type.index');
       
    }
}
