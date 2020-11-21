<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        User::create([
            'name'=>'shimo',
            'password'=>'123',
            'email'=>'admin@gmail.com',
        ]
    );



    }
}
