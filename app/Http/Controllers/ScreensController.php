<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Screen;
use Session; 
use app\Http\helper\Helper as Helper;
use DB;

class ScreensController extends Controller 
{
	public function index(Request $request)
	{
		Helper::checkUserSession();
		Helper::checkPagePermission('VW_SCREEN','view',session('userRoleIDs'));
        $screens = Screen::orderBy('id','desc');
        if(isset($request->search))
		{
             $screens = $screens->where('name','LIKE','%'.$request->search.'%');
  
        }
		 
          $screens = $screens->paginate(10);

        return view('Admins.screens.index',compact('screens'))->with('i', 1);
    }
	public function create()
    {
		Helper::checkUserSession();
		Helper::checkPagePermission('CR_SCREEN','create',session('userRoleIDs'));
        return view('Admins.screens.create');
    }

	public function store(Request $request)
    {
		$isPagecodeExist =Screen::where('page_code',$request->page_code)->first();
		if($isPagecodeExist){
			Session::flash('error', 'Page Code Already exist. its must be unique');

			return redirect()->back()->withInputs($request->all());
		}
        $screen = new Screen();
		$screen->page_name = $request->page_name;
		$screen->page_url = $request->page_url;
		$screen->label = $request->label;
		$screen->page_code = $request->page_code;
		$screen->module = $request->module;
		$screen->show_menu = $request->show_menu;
         
         if($screen->save())
		 {
		 	$screen_id = $screen->id;
		 	$allRoles = Role::get_roles('','','all');
			foreach($allRoles as $roles)
			{
				$resIns = DB::table('roles_permissions')->insert(array( 'role_id' => $roles->id, 'page_id' => $screen_id, 'allowed' => 'N', 'page_code' => $request->page_code));
			}
		 	
		 	Session::flash('message', 'Screen has been added successfully');
		 }

        return redirect()->route('manage-screen.index');
    }


	function save_screens(Request $request)
	{
		Helper::checkUserSession();
		//echo "<pre>";
		//print_r($request->all());die;
		 
		 $res= Screen::save_screens($request->all());
		  if ($res) {
			// Set a session flash message and redirect.
				Session::flash('message', 'Role Permission has been added successfully');
				 return redirect('/admin/manage-permission?status=1');
				return false;
			}else{
				Session::flash('message', 'Role Permission not added successfully');
				 return redirect('/admin/manage-permission?status=0');
			}
		
	}



	function update_screens(Request $request)
	{
		Helper::checkUserSession();
		  $res= Screen::save_screens($request->all());
		  if ($res) 
		  {
			// Set a session flash message and redirect.
			
				Session::flash('message', 'Role Permission has been updated successfully');
				 return redirect('/admin/manage-permission?status=1');
				
				return false;
			}
			else
			{
				Session::flash('message', 'Role Permission not updated successfully');
				 return redirect('/admin/manage-permission?status=0');
				
			}
	}

}

?>