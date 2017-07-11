<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
             // $this->call(UsersTableSeeder::class);
         DB::table('users')->insert(
[['name' => "a",'email' => str_random(10).'@gmail.com','password' => bcrypt('123456789')],[
 'name' => "B",            'email' => str_random(10).'@gmail.com',            'password' => bcrypt('123456789'), ]]);
    }
    }
}
