<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_has_permissions')->insert([

            // Admin
            [
                'permission_id' => 1,
                'role_id' => 1,

            ],
            [
                'permission_id' => 2,
                'role_id' => 1,

            ],
            [
                'permission_id' => 3,
                'role_id' => 1,

            ],







        ]);
    }
}
