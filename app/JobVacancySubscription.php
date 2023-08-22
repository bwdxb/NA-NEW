<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class JobVacancySubscription extends Model
{

    protected $table = 'job_vacancy_subscription';
    protected $primaryKey = 'id';
    protected $fillable = [
//        'id',
//        'logo',
//        'job_id',   // generate unique job id : Job ID should start with: RNA followed by the number
//        'job_category', // Experienced Professionals/ UAE Nationals
//        'job_title',    // job position
//        'job_description',  // job position
//        'job_reqiurement',  // Qualifications and Experience
//        'employment_type',  // Full-time, Part-time, Contract, Temporary, Volunteer, Internship
//        'salary_package',   // Salary and Benefits
//        'department',
//        'location ',
//        'vacancy_closing_date ',
//        'status',   //default pending


        'id',
        'name',
        'email',
        'job_category', // Experienced Professionals/ UAE Nationals, clinical, non-clinical, UAE Nationals
        'status',   //default pending
    ];
}