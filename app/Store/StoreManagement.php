<?php

namespace App\Store;

use Illuminate\Database\Eloquent\Model;

class StoreManagement extends Model
{
    protected $table = 'store_management';

    public function getProductDetail(){
    	return $this->belongsTo('App\Product','Product_ID','Product_ID');
    }

    public function getOffer(){
        return $this->belongsTo('App\Offer','coupon_id','id');
    }
    public function categoryDetails() {
    	return $this->belongsTo('App\Category','category_id','id');
    }

    public function subCategoryDetails() {
    	return $this->belongsTo('App\Subcategory','subcategory_id','id');
    }
   
    public function getBrand(){
    	return $this->belongsTo('App\Brand','brand_id','id');
    }
    
}
