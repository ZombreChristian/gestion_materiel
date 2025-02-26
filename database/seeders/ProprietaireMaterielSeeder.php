<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProprietaireMateriel;
use Illuminate\Database\Seeder;

class ProprietaireMaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Générer 10 propriétaires de matériel
      ProprietaireMateriel::factory()->count(20)->create();
    }
}
