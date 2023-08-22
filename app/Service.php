<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service_management';
    // protected $fillable=[
    //      'title','description',

    // ];

    protected $fillable = [
        'id',
        'name',
        'slug',
        'image',
        'description',
        'status',
        'created_by',
        'updated_by',
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
