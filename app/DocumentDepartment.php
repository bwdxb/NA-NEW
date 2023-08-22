<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentDepartment extends Model
{
    protected $table = 'document_department';
    protected $fillable=['department'];

    public function getUser($id){
        $user = User::find($id);
        if($user){

            return $user->first_name." ".$user->last_name;
        }
        return "nil";
    }
}
