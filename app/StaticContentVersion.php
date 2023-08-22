<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticContentVersion extends Model
{
    protected $table = 'static_content_version';

    protected $fillable=[
        'static_content_id',
        'parent_id',
        'title',
        'title_ar',
        'slug',
        'image',
        'banner',
        'sequence_number',
        'description',
        'description_ar',
        'reverted',
        'status',
        'created_by'
    ];

    public function user()
    {
        return User::find($this->created_by);
    }
    
    public function parentMenu()
    {
        return Menu::find($this->parent_id);
    }
}
