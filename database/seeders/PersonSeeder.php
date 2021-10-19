<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("people")->insert([
            "firstName" => "Super",
            "lastName" => "Admin",
            "cellPhone" => "3324353442",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("people")->insert([
            "firstName" => "Carlos",
            "lastName" => "Hernandez",
            "cellPhone" => "3122435454",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
