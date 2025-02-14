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
        // Récupérer les IDs des permissions
        $permissions = DB::table('permissions')->pluck('id')->toArray();

        // Vérifier si les permissions existent
        if (count($permissions) >= 3) { // Assure-toi qu'il y a au moins 3 permissions
            DB::table('role_has_permissions')->insert([
                [
                    'permission_id' => $permissions[0],
                    'role_id' => 1,
                ],
                [
                    'permission_id' => $permissions[1],
                    'role_id' => 1,
                ],
                [
                    'permission_id' => $permissions[2],
                    'role_id' => 1,
                ],
            ]);
        } else {
            // Si les permissions n'existent pas, loguer ou gérer l'erreur
            \Log::error('Permissions not found. Please insert permissions first.');
        }
    }
}