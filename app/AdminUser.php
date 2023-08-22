<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table='users';
    protected $fillable = [
        'name','image',"gst_no","status"
    ];

}
