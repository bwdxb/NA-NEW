<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MarketItemImages extends Model
{

    protected $table = 'market_item_images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'market_item_id',
//        'employee_id',
        'file_url',
        'cover_status',   //default pending
        'created_at',
        'updated_at',
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function marketPlaceItem()
    {
        $marketPlaceItem = MarketPlace::find($this->market_item_id);
        if (!$marketPlaceItem) {
            Log::error('market_item_images_id : ' . $this->id.' failed to fetch marketPlaceItem in MarketItemImages Model');
        }
        return $marketPlaceItem;
    }

}