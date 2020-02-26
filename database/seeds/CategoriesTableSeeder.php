<?php
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // factory(Category::class, 10)->create();

        $data = [
            [
                'name' => 'Laptops',
                'keyword' => 'laptop',
                'picture' => '/upload/imgCategory/laptop.jpg',
                'parent_id' => 0,
            ],
            [
                'name' => 'Smart phones',
                'keyword' => 'smart-phone',
                'picture' => '/upload/imgCategory/smartphone.jpg',
                'parent_id' => 0,
            ],
            [
                'name' => 'Accessories',
                'keyword' => 'accessory',
                'picture' => '/upload/imgCategory/accessory.jpeg',
                'parent_id' => 0,
            ],
            [
                'name' => 'Laptop ASUS',
                'keyword' => 'laptop-asus',
                'picture' => '/upload/imgCategory/laptop-asus.jpg',
                'parent_id' => 1,
            ],
            [
                'name' => 'Laptop DELL',
                'keyword' => 'laptop-dell',
                'picture' => '/upload/imgCategory/laptop-dell.jpg',
                'parent_id' => 1,
            ],
            [
                'name' => 'Laptop HP',
                'keyword' => 'laptop-hp',
                'picture' => '/upload/imgCategory/laptop-hp.jpg',
                'parent_id' => 1,
            ],
            [
                'name' => 'Laptop LENOVO',
                'keyword' => 'laptop-lenovo',
                'picture' => '/upload/imgCategory/laptop-lenovo.png',
                'parent_id' => 1,
            ],
            [
                'name' => 'Smart Phone IPHONE',
                'keyword' => 'smart-phone-iphone',
                'picture' => '/upload/imgCategory/smartphone-iphone.png',
                'parent_id' => 2,
            ],
            [
                'name' => 'Smart Phone SAMSUNG',
                'keyword' => 'smart-phone-samsung',
                'picture' => '/upload/imgCategory/smartphone-samsung.png',
                'parent_id' => 2,
            ],
            [
                'name' => 'Smart Phone ASUS',
                'keyword' => 'smart-phone-asus',
                'picture' => '/upload/imgCategory/smartphone-asus.jpg',
                'parent_id' => 2,
            ],
            [
                'name' => 'CAMERA',
                'keyword' => 'camera',
                'picture' => '/upload/imgCategory/camera.png',
                'parent_id' => 3,
            ],
            [
                'name' => 'HEADPHONE',
                'keyword' => 'headphone',
                'picture' => '/upload/imgCategory/headphone.jpeg',
                'parent_id' => 3,
            ],
        ];
        Category::insert($data);
    }
}
