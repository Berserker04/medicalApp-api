<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("employees")->insert([
            "firstName" => "Super",
            "lastName" => "Admin",
            "document" => "33243542",
            "cellPhone" => "3324353442",
            "specialty_id" => 1,
            "profession_id" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("employees")->insert([
            "firstName" => "Carlos",
            "lastName" => "Perea",
            "document" => "3324355622",
            "cellPhone" => "3324353442",
            "specialty_id" => 1,
            "profession_id" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
