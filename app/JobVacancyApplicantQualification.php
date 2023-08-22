<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class JobVacancyApplicantQualification extends Model
{

    protected $table = 'vacancy_documents';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'program',
        'certitification_type',
        'certificate_files',
        'vacancy_id',
        'status',   //default pending
    ];
}