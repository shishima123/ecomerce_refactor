<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Phuoc',
                'email' => 'phuoc@gmail.com',
                'role' => 'administrator',
                'password' => bcrypt('1'),
                'picture' => '/upload/userPic/avatar default.jpg',
                'phone' => '12345678',
                'address' => "Hue",
            ],
            [
                'name' => 'Duy',
                'email' => 'duy@gmail.com',
                'role' => 'administrator',
                'password' => bcrypt('1'),
                'picture' => '/upload/userPic/avatar default.jpg',
                'phone' => '12345678',
                'address' => "Hue",
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'role' => 'user',
                'password' => bcrypt('1'),
                'picture' => '/upload/userPic/avatar default.jpg',
                'phone' => '12345678',
                'address' => "DN",
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'role' => 'user',
                'password' => bcrypt('1'),
                'picture' => '/upload/userPic/avatar default.jpg',
                'phone' => '12345678',
                'address' => "HN",
            ], [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'role' => 'user',
                'password' => bcrypt('1'),
                'picture' => '/upload/userPic/avatar default.jpg',
                'phone' => '12345678',
                'address' => "HCM",
            ],
        ];
        User::insert($data);
    }
}
