<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGalleryVersion extends Model
{
    protected $table = 'video_gallery_version';
    protected $fillable = [
        'id',
        'video_gallery_id',
        'cat_id',
        'lang',
        'title',
        'title_ar',
        'video_date',
        'youtube_link',
        'youtube_link_ar',
        'status',
        'reverted',
        'created_by',
        'updated_by',
    ];

    public function getCategory()
    {
        return VideoCategory::find($this->cat_id);
    }
    public function user()
    {
        return User::find($this->created_by);
    }
}
