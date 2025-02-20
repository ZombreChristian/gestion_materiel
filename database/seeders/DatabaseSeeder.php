<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  \App\Models\User::factory(0)->create();
        //    \App\Models\Membre::factory(200)->create();
         $this->call(PermissionsTableSeeder::class);
          $this->call(RolesTableSeeder::class);
          $this->call(RolesHasPermissionsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
          $this->call(ModelHasRoleTableSeeder::class);
          $this->call(EquipementSeeder::class);






        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
