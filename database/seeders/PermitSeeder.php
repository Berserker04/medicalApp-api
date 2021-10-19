<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permits")->insert([
            "name" => "read",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("permits")->insert([
            "name" => "update",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("permits")->insert([
            "name" => "delete",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("permits")->insert([
            "name" => "desactive",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
