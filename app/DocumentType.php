<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'document_type';
    protected $fillable=['type'];

    public function getUser($id){
        $user = User::find($id);
        if($user){

            return $user->first_name." ".$user->last_name;
        }
        return "nil";
    }
}
