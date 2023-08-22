<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='notification';
    protected $fillable=[
        'title',
    	'description',
        'type',
        'url',
        'send_to',
        'seen_by',
        'created_by',
        'updated_at',
        'created_at',

    ];
}
