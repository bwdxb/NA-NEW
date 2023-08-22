<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocLibrary extends Model
{
    protected $table = 'doc_library';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'controlled_number',

        'document_name',
        'document_version_number',
        'department_owner',
        'document_type',

        'document_issue_date',
        'data_classification',

        'document_file_url',
        'document_file_type',
        'document_file_size',

        'status',   //default pending
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
