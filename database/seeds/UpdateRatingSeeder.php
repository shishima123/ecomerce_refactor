<?php

use App\CommentRating;
use App\Product;
use Illuminate\Database\Seeder;

class UpdateRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = CommentRating::selectRaw('comment_ratings.*,avg(comment_ratings.rating) as avg_rating')->groupBy('product_id')->get();
        foreach ($ratings as $rating) {
            Product::where('id', '=', $rating->product_id)->update(['rating' => $rating->avg_rating]);
        }
    }
}
