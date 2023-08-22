<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Session; 
use DB;

class RolesController extends Controller
{
	public function index(Request $request)
    {
		$roles = Role::orderBy('id','ASC');  
		return view('Admins.manage_roles', compact('roles'));
	}
	function save_role(Request $request)
	{
	 	//$this->checkUserSession();
			$roleExists = DB::table('roles')->where(['role_name' => $request['role_name']])->get()->toArray();

	    	if(!$roleExists)
			{
					$role = new Role();
					$role->role_name = $request->role_name;
					$role->IsActive = $request->IsActive;
					  if ( $role->save()) 
					  {
						Session::flash('message', 'Role  has been added successfully');
						return redirect('/admin/add-permission?status=1');
					   
						return false;
		        	}
		        else
				{
					 Session::flash('message', 'Role not add. There is some Problem');
			 		return redirect('/admin/add-permission?status=0');
					
				}
			
			}
	 
	 }
	/* 
		This function is used to get all roles of specific user
		@$user_id: User Id of the user	
	*/
	function get_user_roles($user_id,$start,$limit , $role_id = '')
	{
		$res = $this->Role->get_user_roles($user_id,$start,$limit,$role_id);
		return $res;	
	}	
	
	function get_user_roles_count($user_id , $role_id = '')
	{
		$res = $this->Role->get_user_roles_count($user_id , $role_id);
		return $res;
	}

	
	/* 
	This function is used to assing multiple 
	roles to the user.
	*/
	function save_user_roles(Request $request)
	{
	 //$this->checkUserSession();
		if(Role::save_user_roles($request->all()))
		{
			 Session::flash('message', 'User Roles has been updated successfully');
			 return redirect('/admin/manage-roles?status=1');
		}
		else
		{
			Session::flash('message', 'User Roles not updated successfully');
			 return redirect('/admin/manage-roles?status=0');
		}
		
	}
	
	function get_roles_id($id)
	{
		$roles = $this->Role->find('all', array(
	        'conditions' => array('Role.IsActive' => '1','Role.id LIKE' => $id)
	   	 ));
	}
	
/*This function is used to get role list from roles table depending upon the array of role types paessed*/
	function get_role_usertype($arr)
	{
		$res = $this->Role->find('all', array(
				'fields' => array('Role.id, Role.role_code , Role.role_name' ),
				'conditions' => array('Role.role_code IN' => $arr)
			 ));
			
		return $res;
		
	}
	
/*This function is used to return role_name from roles table list of the passes $user_type*/
	function get_role_name($user_type)
	{
		$res = $this->Role->find('all', array(
				'fields' => array('Role.role_name, Role.id' ),
				'conditions' => array('Role.role_code' => $user_type)
			 ));
			
		return $res[0]['Role']['role_name'];
		
	}
	
	 public function status($id)
    {

        $role = Role::where('id', $id)->first();

        if ($role->IsActive == 1)
        {
            $role->	IsActive = 0; //0 for Block
            $role->save();

        }
        else $role->IsActive = 1; //1 for Unblock
        $role->save();

        if ($role->IsActive == 1)
        {
            return 1;
        }
        else
        {
            return 2;
        }

    }	
}
