<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TeamSalute extends Model
{

	protected $table = 'team_salute';
	protected $primaryKey = 'id';
	protected $fillable = [
		'id',
		'ts_for',
		'category',
		'ts_from',
		'ts_to',
		'ts_date',
		'created_at',
		'updated_at',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
	];

	protected $dates = [
		'created_at',
		'updated_at',
	];
	public function getUserFullName()
	{
		$userFullName = '';
		$user = $this->getUserInfo();
		if ($user) {
			$userFullName = $user->first_name . ' ' . $user->last_name;
		}
		return $userFullName;
	}

	public function getUsername()
	{
		$username = '';
		$user = $this->getUserInfo();
		if ($user) {
			$username = $user->user_name;
		}
		return $username;
	}

	public function getUserInfo()
	{
		$user = User::find($this->created_by);
		if (!$user) {
			//            Log::error('Story model : ' . $this->id .' : invalid user info for created_by');
		}
		return $user;
	}
	public function getToUserInfo()
	{
		// $user = User::select(DB::raw("CONCAT(first_name,' ',last_name) AS first_name"))->first()->where('first_name',$this->ts_to)->first;
		// dd($user);
		$tsUser = explode(" ", $this->ts_to);
		$user = User::query();
		if (isset($tsUser[0])) {

			$user = $user->where("first_name", $tsUser[0]);
		}
		if (isset($tsUser[1])) {
			$user = $user->where("last_name", $tsUser[1]);
		}
		$user = $user->first();
		if (!$user) {
			//            Log::error('Story model : ' . $this->id .' : invalid user info for created_by');
		}
		return $user;
	}
}
