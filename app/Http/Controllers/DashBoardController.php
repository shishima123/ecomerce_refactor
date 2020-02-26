<?php

namespace App\Http\Controllers;

use App\Category;
use App\CommentRating;
use App\Order;
use App\Product;
use App\User;

class DashBoardController extends Controller
{
    public function index()
    {
        $categories = Category::count('id');
        $users = User::count('id');
        $products = Product::count('id');
        $orders = Order::count('id');
        $comments = CommentRating::where('content', '<>', '')->count('id');
        return view('Admin.dashboard')->with('data', [[$categories, 'category'], [$users, 'user'], [$products, 'product'], [$orders, 'order'], [$comments, 'comment']]);
    }
}
