<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentClassification extends Model
{
    protected $table = 'document_classification';
    protected $fillable=['classification'];

    public function getUser($id){
        $user = User::find($id);
        if($user){

            return $user->first_name." ".$user->last_name;
        }
        return "nil";
    }
}
