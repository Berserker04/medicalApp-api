<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("role_permits")->insert([
            "role_id" => 1,
            "permit_id" => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table("role_permits")->insert([
            "role_id" => 2,
            "permit_id" => 3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
