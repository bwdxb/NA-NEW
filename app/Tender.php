<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
     protected $table='tender_management';
    protected $fillable=[
    	'name','file',

    ];
}
