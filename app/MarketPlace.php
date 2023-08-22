<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MarketPlace extends Model
{

    protected $table = 'market_place';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'title',
        'email',
        'phone',
        'category',
        'price',
        'address',
        'description',
        'photo',
        'status',
        'interested_users',
        'created_by',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function itemCoverImage()
    {
       $itemCoverImage = MarketItemImages::where('market_item_id', $this->id)->where('cover_status', 1)->get()->first();
        // $itemCoverImage = MarketItemImages::where('market_item_id', $this->id)->where('cover_status', 1)->latest()->first();
        if (!$itemCoverImage) {
            Log::error('market_item_id : ' . $this->id . ' failed to fetch itemCoverImage in MarketPlace Model');
        }
        return $itemCoverImage;
    }
public function getIntrestedUsers(){
    // dd($this->interested_users);
    return User::find(explode(',',$this->interested_users));
}
    public function itemImages()
    {
       $itemImages = MarketItemImages::where('market_item_id', $this->id)->get();
        // $itemImages = MarketItemImages::where('market_item_id', $this->id)->latest();
        if (!$itemImages) {
            Log::error('market_item_id : ' . $this->id . ' failed to fetch itemImages in MarketPlace Model');
        }
        return $itemImages;
    }

    public function getUserFullName()
    {
        $userFullName = '';
        $user = $this->getUserInfo();
        if ($user) {
            $userFullName = $user->first_name . ' ' . $user->last_name;
        }
        return $userFullName;
    }

    public function getUserInfo()
    {
        $user = User::find($this->created_by);
        if (!$user) {
//            Log::error('Story model : ' . $this->id .' : invalid user info for created_by');
        }
        return $user;
    }
}