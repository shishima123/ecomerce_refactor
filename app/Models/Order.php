<?php

namespace App;

use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot(['quantity', 'price', 'total']);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
