<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCMS extends Model
{
    protected $table = 'cms_service_management';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'title',
        'title_ar',
        'banner',
        'intro',
        'intro_ar',
        'concl',
        'concl_ar',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
