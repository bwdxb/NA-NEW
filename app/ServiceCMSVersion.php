<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCMSVersion extends Model
{
    protected $table = 'cms_service_management_version';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'cms_id',
        'title',
        'title_ar',
        'banner',
        'intro',
        'intro_ar',
        'concl',
        'concl_ar',
        'created_at',
        'updated_at',
        'created_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return User::find($this->created_by);
    }

}
