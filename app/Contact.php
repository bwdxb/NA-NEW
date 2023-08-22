<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
     protected $table='contact_information';
    
     public function user()
     {
         return User::find($this->created_by);
     }
}
