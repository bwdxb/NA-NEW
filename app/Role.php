<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model{

 protected $table='roles';


public static function get_roles($data='',$search='',$all='')
{
	if($search=='')
	{
		 if($all=='all')
		 {
		 
		 	$roles = Role::where('IsActive',1)->get(); 
				
		}
		else
		{
		
			$roles = Role::where(['IsActive' => 1,'permission_assigned' => 0])->get();
			
		}
	}
	else
	{
	
			$roles = Role::where(['IsActive' => 1,'permission_assigned' => 0,'role_name LIKE' =>'%'.$data.'%'])->get();			
	}
	    
	    return $roles;
	    
	}
	/*
		Get all roles of user
	*/
	public static function get_user_roles($user_name,$start,$limit,$role_id='')
	{
		
		 $users = DB::table('users')->join('users_roles', 'users.id', '=', 'users_roles.user_id')->orderBy('users.id','desc');
		 $users = $users->where('users.IsDelete', 0 );
		  //$users = $users->where('users.user_type', 'SUP' );
		
		if(!empty($role_id)){
		 //$users = $users->where('users_roles.role_id', $role_id );
		}
		
		if(!empty($user_name)){
		
		$users = $users->where('users.first_name', 'LIKE', '%' . $user_name . '%')
				->orWhere('users.last_name', 'LIKE', '%' . $user_name . '%')
    			->orWhere('concat(users.first_name," ",users.last_name)', 'LIKE', '%' . $user_name . '%');
		}
		
		
		$userlist = $users->select('users_roles.*' , 'users.id' , 'users.first_name' , 'users.last_name')->paginate(10);
		$res = $userlist->toArray();
		 
		
		if(!empty($role_id) && count($res))
		{
			
			$user_list = '';
			
			foreach($res['data'] as $r)
			{
			
					echo $user_list .= $r->user_id .',';
			}
			
			$user_list = substr($user_list , 0 ,-1);
			 $users = DB::table('users')->join('users_roles', 'users.id', '=', 'users_roles.user_id')->orderBy('users.id','desc');
			 $users = $users->whereIn('users_roles.user_id.IsDelete', $user_list );
			 $users = $users->select('users_roles.*' , 'users.id' , 'users.first_name' , 'users.last_name')->get();
			 $res = $users->toArray();	
				
		}
		
		
		
 		if($res){
		 	$i=0;
		 	
		 	foreach($res['data'] as $r){
			
					$user[$r->user_id][$r->id] = array($r->first_name,$r->last_name);
				
				//print_r($user[$r['ur']['user_id']]);
				++$i;
			}
			
			return $user ;
			
			
		}else{
			return false;
		}
		exit;
	}
	
	/* get coutn of users roles which will be used in pagination */
	function get_user_roles_count($user_name , $role_id = '')
	{
		$db = ConnectionManager::getDataSource('default');
		$sql='SELECT ur.*, u.first_name,u.last_name FROM users_roles as ur INNER JOIN users AS u ON ur.user_id=u.id';
		
		if(!empty($role_id)){
			$sql .= ' AND ur.role_id = '.$role_id;	
		}
		
		if(!empty($user_name)){
			$sql .= ' AND (u.first_name LIKE "%'.$user_name.'%" OR u.last_name LIKE "%'.$user_name.'%" OR concat(u.first_name," ",u.last_name) LIKE "%'.$user_name.'%")';	
		}

		$sql .= ' where u.user_type !=  "SUP" and u.IsDelete = 0 ';

		$res = $db->query($sql);
		return count($res);		
	}
	
	/* Save users role in users_role table*/
	public static function save_user_roles($data) 
	{
		if(count($data['user_id'])>0)
		{
			
			foreach($data['user_id'] as $uid)
			{
				$i=0;
				$role_ids='';
				foreach($data['roles_'.$uid] as $role_id){
				 count($data['roles_'.$uid]);
				if(count($data['roles_'.$uid]))
				{
					$delSql = DB::table('users_roles')->where('user_id', $uid)->delete();
						
					$sql = DB::table('users_roles')->where(['role_id' => $role_id,'user_id' => $uid])->get();
					$res = $sql->toArray();
					
						if(count($res)==0)
						{
							$resIns = DB::table('users_roles')->insert(array( 'role_id' => $role_id, 'user_id' => $uid));
						}
						
						 if(!$i)
						 {
						   $sql = DB::table('roles')->where(['id' => $role_id,'IsActive' => 1])->get(); 
						   $res = $sql->toArray();
						    
						   $updatesql = DB::table('users')->where('id', $uid)->update(array('role_id' => $res[0]->id)); 
						   
						   
						   //$update1sql = 'UPDATE other_users SET role_id  = "'.$role_id.'" where user_id = '.$uid;  
						   //$update1res = $db->query($update1sql);  
						          
						 	$i++;
						 }
						
				}
				
				
				}
				
				
			}
			
		
			if(@$resIns || $res)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	public static function get_roletype($role_id)
	{
		$res = Role::where(['id' => $role_id, 'IsActive'=>1])->get()->toArray();
		
		return $res[0]['id'];
		
	}
	
	function getRoles()
	{
		return $this->Role->find("all");
	
	}	
}