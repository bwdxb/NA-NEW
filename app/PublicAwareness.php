<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PublicAwarenessFaq;
use App\PublicAwarenessCategory;
class PublicAwareness extends Model
{
    protected $table='public_awareness';


    public function faq()
    {
        // dd($this->id);
        return PublicAwarenessFaq::where('status',1)->where('awareness_id',$this->id)->get();
        // return $this->hasMany(PublicAwarenessFaq::class,'awareness_id','id');

    }
}
