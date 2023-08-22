<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'type',
        'title',
        'name',
        'nationality',
        'contact',
        'email',
        'cad',
        'incident_date',
        'area_location',
        'emirates',
        'feedback_message',
        'feedback_ref',
        'solution',
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
