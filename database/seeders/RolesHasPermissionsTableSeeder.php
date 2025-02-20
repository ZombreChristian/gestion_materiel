<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifie si les permissions existent dans la base de données
        $permissions = Permission::whereIn('id', [1, 2, 3])->pluck('id')->toArray();

        if (count($permissions) < 3) {
            $this->command->error("Certaines permissions n'existent pas. Exécute d'abord le seeder des permissions.");
            return;
        }

        // Vérifie si le rôle admin existe
        $adminRole = Role::find(1);
        if (!$adminRole) {
            $this->command->error("Le rôle Admin n'existe pas. Exécute d'abord le seeder des rôles.");
            return;
        }

        // Associer les permissions au rôle admin
        foreach ($permissions as $permissionId) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permissionId,
                'role_id' => $adminRole->id,
            ]);
        }

        $this->command->info("Les permissions ont été correctement associées au rôle Admin.");
    }
}
