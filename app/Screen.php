<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Screen extends Model {

	protected $table='screens';
	
	public static function get_screens($id ='')
	{
		if(!empty($id))
		{
		
			$screens = DB::table('roles_permissions as rp')
                    ->join('screens as s', 'rp.page_code', '=', 's.page_code')
                    ->where(['rp.role_id' => $id])
					->orderBy('s.module','DESC')
                    ->select('rp.page_id','rp.page_code','s.label','s.module', 'rp.allowed')->get()->toArray();
			
		}
		else
		{
			$screens = Screen::where(['allow_tracking' => 1])
					->orderBy('module','DESC')->get()->toArray();
			
		}
		
	    return $screens;
    }
	
	public static function save_screens($input_data, $type='ins')
	{
	
		$role_id = $input_data['role_id'];
		$exitPermission='';
		$i=0;
			
		/* Insert all the records in role_permissions table first with allowed=N */
		foreach($input_data['page_ID'] as $pageID)
		{	
				$result = DB::table('roles_permissions')->where(['page_id' => $pageID,'role_id' => $role_id])->select('page_id','page_code')->get()->toArray();
			
				if(count($result)==0)
				{
					$r =DB::table('screens')->where(['id' => $pageID])->select('page_code')->get()->toArray();
					
					$page_code = $r[0]->page_code; /* Get page_code for current pageid */
					$res = DB::table('roles_permissions')->insert(array( 'role_id' => $role_id, 'page_code' => $page_code,'page_id' => $pageID, 'allowed'=>'N'));
				}
		}
		
		
		/* loop throught each selected pagecode and update the allowed field to Y */
		foreach($input_data['page_code'] as $page_code){
			$page_code = $page_code;				
					$res = DB::table('roles_permissions')->where(['role_id' => $role_id,'page_code' => $page_code])->update(array('allowed' => 'Y'));
					$exitPermission.= '"'.$page_code.'",';
				
				
			++$i;			
		} /* end of foreach loop page_code */
		
		/* set allowed to N if there is no request for it */
		if(!empty($input_data['page_code']))
		{		
			$res = DB::table('roles_permissions')->where(['role_id' => $role_id])->whereNotIn('page_code', $input_data['page_code'])->update(array('allowed' => 'N'));
		}
		
		DB::table('roles')->where(['id' => $role_id])->update(array('permission_assigned' => 1));
		
		return true;
	}

}

?>