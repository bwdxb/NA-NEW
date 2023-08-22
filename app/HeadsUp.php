<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class HeadsUp extends Model
{

    protected $table = 'heads_up';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'from_',

        'media_type',
        'description',
        'file_url',

        'view_count',   //default 0

        'status',   //default pending
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}