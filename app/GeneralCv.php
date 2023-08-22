<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class GeneralCv extends Model
{

    protected $table = 'general_cv';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'application_ref_number',
        'title',
        'name',
        'nationality',
        'email',    
        'phone',    
        'attach_cv',
        'status',   // New, Reviewed, In Progress, Selected, Rejected.
        'notes',
        'created_at',
        'updated_at',
    ];

}