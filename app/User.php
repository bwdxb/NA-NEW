<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Role;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //'name', 'email', 'password',
    // ];

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'emp_no',
        'user_name',
        'first_name',
        'last_name',
        'email',
        'password',
        'designation',
        'mobile',
        'date_of_birth',
        'image',
        'gender',
        'gst_no',
        'country',
        'city',
        'state',
        'zip_code',
        'status',
        'created_at',
        'updated_at',
        'isDelete',
        'role_id',
        'updated_by',

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    public function roleData()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }
    public function role()
    {
        return Role::find($this->role_id);
    }
    public function full_name()
    {
        return $this->first_name ." ". $this->last_name;
    }
}
