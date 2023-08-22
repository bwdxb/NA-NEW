<?php


namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class JobVacancyVersion extends Model
{

    protected $table = 'job_vacancy_version';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'vacancy_id',
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
        'reverted',
        'created_by',
        'created_at',
        
        'updated_at',
    ];

    public function user()
    {
        $user = User::find($this->created_by);
        return $user;
    }

}