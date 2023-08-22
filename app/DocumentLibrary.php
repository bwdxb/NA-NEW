<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentLibrary extends Model
{
    protected $table = 'document_library';
    protected $fillable = [
        "document_type_id",
"controlled_number",
"document_name",
"document_file",
"version_number",
"department_owner",
"data_classification",
"file_type".
"file_size".
"document_date",
"created_by",
"updated_by",
    ];
}
