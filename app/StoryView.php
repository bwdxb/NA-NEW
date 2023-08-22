<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class StoryView extends Model
{

    protected $table = 'story_view';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'story_id',   //nullable
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}