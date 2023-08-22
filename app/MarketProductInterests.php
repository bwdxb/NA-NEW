<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketProductInterests extends Model
{

    protected $table = 'market_product_interests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'market_item_id',
        'interested_employee_id',
        'status',   //default pending
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}