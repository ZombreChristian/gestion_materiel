<?php

namespace Database\Seeders;
use App\Models\TypeMateriel;
use App\Models\Materiel;
use App\Models\StatutReservation;
use APP\Modeels\Reservation;
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
         $this->call(UsersTableSeeder::class);
         $this->call(RolesHasPermissionsTableSeeder::class);
          $this->call(ModelHasRoleTableSeeder::class);
          
          $this->call(TypeMaterielSeeder::class);
          Materiel::factory(20)->create();

          $this->call(StatutReservationSeeder::class);



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
