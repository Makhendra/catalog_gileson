<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['id',  'title', 'image', 'description', 'first_invoice', 'url', 'price', 'amount'];
    
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'product_category', 'product_id', 'category_id');
    }

    public function offers()
    {
        return $this->belongsToMany('App\Offer', 'product_offer', 'product_id', 'offer_id');
    }
}
