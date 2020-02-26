<?php

use App\ImageProduct;
use App\Product;
use Illuminate\Database\Seeder;

class ImageProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::with('category')->get();
        global $cate;
        foreach ($products as $product) {
            switch ($product->category->id) {
                case "4":
                    $cate = 'asus';
                    break;
                case "5":
                    $cate = 'dell';
                    break;
                case "6":
                    $cate = 'hp';
                    break;
                case "7":
                    $cate = 'lenovo';
                    break;
                case "8":
                    $cate = 'iphone';
                    break;
                case "9":
                    $cate = 'samsung';
                    break;
                case "10":
                    $cate = 'zenphone';
                    break;
                case "11":
                    $cate = 'nikon';
                    break;
                case "12":
                    $cate = 'beat';
                    break;
            }
            for ($i = 1; $i < 4; $i++) {
                $data = [
                    'product_id' => $product->id,
                    'path' => '/upload/imgDetailProduct/' . $cate . $i . '.jpg',
                    'del_flg' => '0'
                ];
                ImageProduct::insert($data);
            }
        }
    }
}
