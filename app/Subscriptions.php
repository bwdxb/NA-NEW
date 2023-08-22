<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{

    protected $table = 'subscriptions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'email',
        'job_category',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

  

    public function getSubscribers()
    {
        $data = self::where('status','ACTIVE')->get();
      
        return $data;
    }
  
 
}