<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class JobVacancyApplicantion extends Model
{

    protected $table = 'job_vacancy_application';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'job_vacancy_id',
        'application_ref_number',
        'title',
        'full_name',
        'gender',
        'dob',
        'nationality',
        'passport_number',  //common for any nationality
        'uid',
        'family_book_number',
        'emirates',
        'emirates_id_number',   //common for any nationality
        'national_service',
        'marital_status',   //common for any nationality
        'email_address',    //common for any nationality
        'mobile_number',    //common for any nationality
        'address',
        'languages_known',  //common for any nationality
        'key_skills',   //common for any nationality
        'country',
        'city',
        'type_of_visa',
        'cv_files',
        'basic_education',
        'supporting_document_files',
        'job_vacancy_medium',
        'status',   // New, Reviewed, In Progress, Selected, Rejected.
        'notes',    //admin operation
        'created_at',
        'updated_at',
    ];

    public function getUserFullName()
    {
        $userFullName = '';
        $user = $this->getUserInfo();
        if ($user) {
            $userFullName = $user->first_name . ' ' . $user->last_name;
        }
        return $userFullName;
    }

    public function getUsername()
    {
        $username = '';
        $user = $this->getUserInfo();
        if ($user) {
            $username = $user->user_name;
        }
        return $username;
    }

    public function getUserInfo()
    {
        $user = User::find($this->created_by);
        if (!$user) {
//            Log::error('Story model : ' . $this->id .' : invalid user info for created_by');
        }
        return $user;
    }
}