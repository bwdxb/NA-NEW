<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{

    protected $table = 'config';
    protected $primaryKey = 'id';
   
}