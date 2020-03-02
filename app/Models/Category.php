<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parentCategories()
    {
        return $this->belongsTo('App\Category', 'parent_id'); //get parent category
    }

    public function subCategories()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id'); //get all subs. NOT RECURSIVE
    }
}
