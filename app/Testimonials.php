<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    protected $table = 'testimonials';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id',
        'category',
        'client_name',
        'client_name_ar',
        'title',
        'title_ar',
        'testimonial',
        'testimonial_ar',
        'status',
        'slug',
        'created_at',
        'updated_at',
    ];

}
