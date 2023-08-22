<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use Auth;
use App\Admin; 
use App\Role;
use App\Screen; 
use DB; 
use app\Http\helper\Helper as Helper;

class AdminsController extends Controller 
{
	function index(Request $request)
	{
	
		Helper::checkUserSession();
		Helper::checkPagePermission('VW_ROLE','view',session('userRoleIDs'));
		
		
        $roles = Role::orderBy('id','desc');
        if(isset($request->role))
		{
             $roles = $roles->where('role_name','LIKE','%'.$request->role.'%');
  
        }
		 
          $roles = $roles->paginate(10);

        return view('Admins.manage_roles',compact('roles'))->with('i', 1); 
		/*$role_list = $rolelist->toArray(); 
		
			foreach ($role_list as $role)
			{
				 $role_option[$role['id']] = $role['role_name'];
			} 
			
		
		$allRoles =Role::get_roles('','','all');
		$allRoles = $allRoles->toArray(); 
		$user_name='';
		$role_id = '';
		
		if(!empty($this->params['url']['name']))
		{
			$user_name = $this->params['url']['name'];
		}
		
		if(!empty($_GET['role']))
		{
			 $role_id  = $_GET['role'];
		}
		
	
		$results = Role::get_user_roles($user_name,$role_id);*/
		
		
	
	}


	function manage_permission()
	{
		Helper::checkUserSession();
		Helper::checkPagePermission('VW_PERM','view',session('userRoleIDs'));
		$allRoles =Role::get_roles('','','all');
		return view('Admins.manage_permission',compact('allRoles'));
		
	}
	
	function add_permission()
	{
		Helper::checkUserSession();
		Helper::checkPagePermission('CR_ROLE','create',session('userRoleIDs'));
		
		$allRoles = Role::get_roles('','','');
		$allRoles = $allRoles->toArray(); 
		
		$allScreens =  Screen::get_screens();
		
		return view('Admins.add_permission',compact('allScreens','allRoles'));
		
	}
	
	function edit_permission()
	{
		Helper::checkUserSession();
		Helper::checkPagePermission('ED_PERM','edit',session('userRoleIDs'));
		
		$allRoles = Role::get_roles('','','all');
		$allRoles = $allRoles->toArray(); 
		
		$allScreens =  Screen::get_screens($_GET['id']);
		
		
		return view('Admins.edit_permission',compact('allScreens','allRoles'));
	}
	
	/* delete permissions */
	function delete_permission()
	{
		$this->checkUserSession();
		$this->checkPagePermission('ED_PERM','delete');
		$res = $this->Admin->delete_permission($_GET['id']);
		if($res)
		{
			$this->Session->setFlash(MSG_DELETE_PERMISSION_SUCCESS , 'default', array(),  'success');
			$this->redirect(array('controller'=>'Admins','action' => 'manage_permission'));	
		}
		else
		{
			$this->Session->setFlash(MSG_DELETE_PERMISSION_FAIL , 'default', array(),  'fail');
			$this->redirect(array('controller'=>'Admins','action' => 'manage_permission'));		
			
		}
		
	}
	/*
	List all user with roles
	*/
	
	function error()
	{
		$this->layout = 'default';
		Helper::checkUserSession();
		
	}
}
?>