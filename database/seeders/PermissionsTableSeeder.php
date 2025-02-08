<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([

            // // Admin
            // [
            //     'name' => 'menu.patient',
            //     'guard_name' => 'web',
            //     'group_name' => 'patient',
            // ],

            [
                'name' => 'menu.utilisateur',
                'guard_name' => 'web',
                'group_name' => 'utilisateur',
            ],
            [
                'name' => 'menu.role',
                'guard_name' => 'web',
                'group_name' => 'role',
            ],

        ]);
    }
}
