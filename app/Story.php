<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    protected $table = 'story';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'category',
        'story',   //nullable

        'media_type',
        'file_url',
        'file_credits',   //nullable

        'like_count',   //default 0
        'dislike_count',   //default 0
        'view_count',   //default 0

        'status',   //default pending
        'dont_publish_name_status',   //default 0(boolean:false -> show name)

        'created_by',
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