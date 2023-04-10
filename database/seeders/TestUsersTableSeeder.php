<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('test_users')->insert([
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'name' => str_random(10),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
