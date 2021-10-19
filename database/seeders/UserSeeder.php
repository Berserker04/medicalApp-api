<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "user_name" => "superAdmin",
            "email" => "admin@gmail.com",
            "password" =>  Hash::make('admin123'),
            "user_id" => null,
            "person_id" => 1,
            "role_id" => 1,
            "state" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("users")->insert([
            "user_name" => "carlos",
            "email" => "carlos@gmail.com",
            "password" => Hash::make('carlos123'),
            "user_id" => null,
            "person_id" => 2,
            "role_id" => 2,
            "state" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
