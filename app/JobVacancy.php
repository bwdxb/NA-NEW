<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{

    protected $table = 'job_vacancy';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'logo',
        'bi_lang',
        'job_id',   // generate unique job id : Job ID should start with: RNA followed by the number
        'job_category', // Experienced Professionals/ UAE Nationals
        'job_category_ar', // Experienced Professionals/ UAE Nationals
        'job_title',    // job position
        'job_title_ar',    // job position
        'job_description',  // job position
        'job_description_ar',  // job position
        'job_reqiurement',  // Qualifications and Experience
        'job_reqiurement_ar',  // Qualifications and Experience
        'employment_type',  // Full-time, Part-time, Contract, Temporary, Volunteer, Internship
        'salary_package',   // Salary and Benefits
        'salary_package_ar',   // Salary and Benefits
        'department',
        'department_ar',
        'location',
        'location_ar',
        'vacancy_closing_date',
        'status',   //default pending
        'applied_count',   //default 0
        'created_at',
        'updated_at',
    ];

    // public function jobApplications()
    // {
    //     $applications = JobVacancyApplicantion::where('job_vacancy_id', $this->id)->get();
    //     return $applications;
    // }

}