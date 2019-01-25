<?php

use App\User;
use Faker\Factory;
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
    	// User::create([
    	// 		'name' => 'Master',
    	// 		'email' => 'master@gmail.com',
    	// 		'password' => bcrypt('secret')
    	// 	]);
        Factory(User::class, 5)->create();
    }
}
