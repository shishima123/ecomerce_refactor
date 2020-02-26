<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\CommentRating;
use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Product::class, function (Faker $faker) {
    $category = Category::where('id', '>', 3)->get()->random()->id;
    global $nmDetailPic;
    global $name;
    global $picture;
    switch ($category) {
        case "4":
            $name = $faker->numerify('Asus VIVOBOOK ###');
            $nmAvatarPic = 'laptop-asus';
            $nmDetailPic = 'asus';
            break;
        case "5":
            $name = $faker->numerify('‎Dell Inspiron ###');
            $nmAvatarPic = 'laptop-dell';
            $nmDetailPic = 'dell';
            break;
        case "6":
            $name = $faker->numerify('HP Probook ###');
            $nmAvatarPic = 'laptop-hp';
            $nmDetailPic = 'hp';
            break;
        case "7":
            $name = $faker->numerify('Lenovo Thinkpad ###');
            $nmAvatarPic = 'laptop-lenovo';
            $nmDetailPic = 'lenovo';
            break;
        case "8":
            $name = $faker->numerify('Iphone #');
            $nmAvatarPic = 'smartphone-iphone';
            $nmDetailPic = 'iphone';
            break;
        case "9":
            $name = $faker->numerify('Galaxy #');
            $nmAvatarPic = 'smartphone-samsung';
            $nmDetailPic = 'samsung';
            break;
        case "10":
            $name = $faker->numerify('Zenphone #');
            $nmAvatarPic = 'smartphone-asus';
            $nmDetailPic = 'zenphone';
            break;
        case "11":
            $name = $faker->numerify('Nikon ###');
            $nmAvatarPic = 'camera';
            $nmDetailPic = 'nikon';
            break;
        case "12":
            $name = $faker->numerify('Beats ###');
            $nmAvatarPic = 'headphone';
            $nmDetailPic = 'beat';
            break;
    }
    $picture = '/upload/avatarProduct/' . $nmAvatarPic . '.jpg';
    $base_url = env('APP_URL');
    $content = '';
    $content .= $faker->text($maxNbChars = 500);
    $content .= '<p><img alt="" src="' . $base_url . '/shop_project/public/upload/imgDetailProduct/' . $nmDetailPic . '1.jpg" style="height:400px; width:400px" /></p>';
    $content .= $faker->text($maxNbChars = 500);
    $content .= '<p><img alt="" src="' . $base_url . '/shop_project/public/upload/imgDetailProduct/' . $nmDetailPic . '2.jpg" style="height:400px; width:400px" /></p>';
    $content .= $faker->text($maxNbChars = 500);
    $content .= '<p><img alt="" src="' . $base_url . '/shop_project/public/upload/imgDetailProduct/' . $nmDetailPic . '3.jpg" style="height:400px; width:400px" /></p>';
    return [
        'category_id' => $category,
        'name' => $name,
        'description' => $faker->text,
        'content' => $content,
        'price' => $faker->numberBetween($min = 500, $max = 900),
        'picture' => $picture,
        'unit' => $faker->randomDigit(),
        'sale' => $faker->randomElement($array = [
            '0', '10', '20',
        ]),
        'new' => $faker->randomElement($array = [
            '0', '1',
        ]),
        'rating' => 0,
        'top_selling' => $faker->randomElement($array = [
            '0', '1',
        ]),
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'role' => $faker->randomElement($array = [
            'administrator',
            'user',
        ]),
        'password' => bcrypt('12345'),
	'picture' => $faker->image(),
        'phone' => $faker->phoneNumber(),
        'address' => $faker->address(),
        'remember_token' => Str::random(10),
    ];
});



$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'code_order' => $faker->creditCardNumber,
        'total' => $faker->numberBetween($min = 1000, $max = 2000),
        'status' => $faker->randomElement($array = [0, 1]),
        'order_name' => $faker->name,
        'order_address' => $faker->secondaryAddress,
        'order_phone' => $faker->phoneNumber,

    ];
});

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => Order::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'quantity' => $faker->numberBetween($min = 10, $max = 20),
        'price' => $faker->randomNumber(2),
        'total' => $faker->numberBetween($min = 500, $max = 700),

    ];
});

$factory->define(CommentRating::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'product_id' => Product::all()->random()->id,
        'content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'rating' => $faker->randomElement($array = [
            '1', '2', '3', '4', '5',
        ]),
    ];
});
