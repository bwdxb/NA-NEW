<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PMONotice extends Model
{
    protected $table = 'pmo_notice';
    protected $fillable = [
        "title",
        "cover_img",
        "banner_img",
        "created_at",
        "updated_at",
        "created_by",
        "updated_by",
    ];
}
