<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $timestamps = false;
    
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_offer', 'category_id', 'product_id');
    }
}
