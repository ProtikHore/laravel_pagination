<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 100; $i++) {
            User::create([
//                'name' => substr(md5(rand()), 0, 5),
                'name' => $faker->name,
//                'email' => rand(1, 12).'@gmail.com',
                'email' => $faker->email,
                'password' => sha1('123'),
                'status' => 'Active',
                'narrative'=> '---'
            ]);
        }
    }
}
