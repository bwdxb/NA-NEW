<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class StoryCategory extends Model
{

    protected $table = 'story_category';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category',
        'created_by',
        'updated_by',
        'status',
    ];

    public function getUser($id){
        $user= User::find($id);
        if($user){
            return $user->first_name.' '.$user->last_name;
        }else{
            return 'Nil';
        }
    }

}