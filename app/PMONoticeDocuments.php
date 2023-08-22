<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PMONoticeDocuments extends Model
{
    protected $table = 'pmo_notice_documents';
    protected $fillable = [
        "pmo_id",
        "document",
        "created_at",
        "updated_at",
        "created_by",
        "updated_by",
    ];
}
