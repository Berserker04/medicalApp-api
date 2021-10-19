<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table("roles")->insert([
        //     "name" => "SuperAdmin",
        //     "state" => 1,
        //     'created_at' => new DateTime(),
        //     'updated_at' => new DateTime(),
        // ]);

        DB::table("roles")->insert([
            "name" => "Admin",
            "state" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table("roles")->insert([
            "name" => "Empleado",
            "state" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
