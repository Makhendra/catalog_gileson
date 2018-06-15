<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    
    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_category', 'category_id', 'product_id');
    }

    public function categoryParent()
    {
        return $this->hasOne('App\Category', 'id', 'parent');
    }

    public function childrens()
    {
        return $this->hasMany('App\Category', 'parent', 'id');
    }
}
