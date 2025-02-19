<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = ['admin', 'Enseignant', 'Responsable de labo', 'Etudiant'];
    
        foreach ($roles as $role) {
            if (!Role::where('name', $role)->where('guard_name', 'web')->exists()) {
                Role::create(['name' => $role, 'guard_name' => 'web']);
            }
        }
    }
}
