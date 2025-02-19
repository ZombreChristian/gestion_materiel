<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Supprimer uniquement les permissions existantes sans TRUNCATE
        DB::table('permissions')->delete();

        // Réactiver les clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insérer uniquement si elles n'existent pas déjà
        Permission::firstOrCreate([
            'name' => 'menu.utilisateur',
            'guard_name' => 'web',
            'group_name' => 'utilisateur',
        ]);

        Permission::firstOrCreate([
            'name' => 'menu.role',
            'guard_name' => 'web',
            'group_name' => 'role',
        ]);
    }
}
