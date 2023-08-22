<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class JobVacancyCategory extends Model
{

    protected $table = 'job_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
//        'logo',
        'job_category', //Experienced Professionals/ UAE Nationals
        'job_category_ar', //Experienced Professionals/ UAE Nationals
        'status',   //default 1
        'created_at',
        'updated_at',
    ];
}