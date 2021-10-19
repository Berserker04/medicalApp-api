<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("specialties")->insert([
            "name" => "Cirujano",
            "profession_id" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("specialties")->insert([
            "name" => "Pediatra",
            "profession_id" => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
