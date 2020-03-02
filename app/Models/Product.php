<?php

namespace App;

use App\Category;
use App\ImageProduct;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['top_selling'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')->withPivot(['quantity', 'price', 'total']);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'comment_ratings')->withPivot(['content', 'rating', 'created_at']);
    }

    public function image_products()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function comment_ratings()
    {
        return $this->hasMany(CommentRating::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Product::class, 'cart_details')->withPivot('qty');
    }
}
