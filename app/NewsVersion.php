<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsVersion extends Model
{
     protected $table='news_management_version';
    protected $fillable=[
    	'cat_id',
    	'news_id',
"lang",
"title",
"alias",
"image",
"cover_img",
"sequence_number",
"source",
"news_date",
"video",
"status",
"short_description",
"description",
"reverted",
"updated_by",
"created_by",

    ];
}
