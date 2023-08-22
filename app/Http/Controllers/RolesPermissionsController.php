<?php

class RolesController extends AppController 
{
	var $name='Roles';
	
   function manage_roles($user_id=NULL) 
   {
  		$this->set('roles',$this->Role->find('all'));;
   }

function save_role()
{
 	if ($this->request->is('post')) {
        // If the form data can be validated and saved...
  		$roleExists = $this->Role->find('all', array(
        'conditions' => array('Role.role_name' => $this->request->data['Role']['role_name'])
    	));
    	if(!$roleExists){
	          if ($this->Role->save($this->request->data)) {
	            // Set a session flash message and redirect.
	            
	            $this->redirect(array('controller'=>'admins','action' => 'add_permission','?'=>array('status'=>'1')));
				return false;
	        }
			
		}else{
			$this->redirect(array('controller'=>'admins','action' => 'add_permission','?'=>array('status'=>'0')));
		}
    }
 }


function get_roles($data='',$search='')
{

	if($search==''){
		$roles = $this->Role->find('all', array(
	        'conditions' => array('Role.IsActive' => '1','Role.permission_assigned' => 0)
	    ));
	}else{
			
			$roles = $this->Role->find('all', array(
        'conditions' => array('Role.IsActive' => '1','Role.role_name LIKE' =>'%'.$data.'%')
   	 ));
	}
    
    return $roles;
    
}

function search_role($data){
	
	$roles = $this->Role->find('all', array(
        'conditions' => array('Role.IsActive' => '1','Role.role_name LIKE' =>'%'.$data.'%')
   	 ));
    return $roles;
}
}
?>