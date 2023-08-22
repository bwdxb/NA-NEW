<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    protected $table = 'todo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'employee_id',
        'todo',
        'date',   //nullable
        'time',   //nullable
        'status',   //default pending
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'hh:mm'
    ];

    protected $dates = [
//        'date',
        'created_at',
        'updated_at',
    ];

}