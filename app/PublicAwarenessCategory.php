<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicAwarenessCategory extends Model
{
    protected $table='public_awareness_category';


    public function faq()
    {
        return $this->hasMany(Comment::class);

    }
}
