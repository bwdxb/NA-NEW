<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Admin extends Model{

var $name='Admin';

function delete_permission($ID){
	$db = ConnectionManager::getDataSource('default');
	$sql="DELETE FROM roles WHERE id=".$ID;

	$ret=false;
	$res = $db->query($sql);
	if(is_array($res))
	{
		$ret=true;
		
		
		$sqlSelect="SELECT * FROM roles_permissions WHERE role_id=".$ID;

		if(count($db->query($sqlSelect))>0){
			$sql="DELETE FROM roles_permissions WHERE role_id=".$ID;		
			$res_1 = $db->query($sql);
		}
	}
	
	return $ret;
}

function check_permission_assinged_to_role($roleid)
{
	 $db = ConnectionManager::getDataSource('default');
	$sqlSelect="SELECT count(*) AS 'rowCount' FROM roles_permissions WHERE role_id=".$roleid;
	$res = $db->query($sqlSelect);
	return $res; 
}

}
?>