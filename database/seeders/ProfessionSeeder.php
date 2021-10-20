<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("professions")->insert([
            "name" => "Medico",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("professions")->insert([
            "name" => "Enfermera",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
