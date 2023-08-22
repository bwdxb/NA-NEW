<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class InternalApplication extends Model{

 protected $table='internal_applications';
 protected $primaryKey = 'id';
 protected $fillable = [
	'id',
	'title',
	'url',
	'logo',
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
}