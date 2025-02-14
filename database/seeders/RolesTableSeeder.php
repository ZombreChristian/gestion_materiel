<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            // admin 1
            [
            'name' =>'admin',
            'guard_name'=>'web',

            ],
            // Rôle Enseignant
            [
                'name' => 'Enseignant',
                'guard_name' => 'web',
            ],

            // Rôle Responsable labo
            [
                'name' => 'Responsable de labo',
                'guard_name' => 'web',
            ],

            // Rôle Etudiant
            [
                'name' => 'Etudiant',
                'guard_name' => 'web',
            ],
    ]);

    }
}
