<?php

namespace Database\Seeders;

use App\Models\Materiel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

      // Générer 50 matériels
      Materiel::factory()->count(50)->create();
    }
}
