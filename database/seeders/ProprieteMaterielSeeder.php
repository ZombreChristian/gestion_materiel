<?php

namespace Database\Seeders;

use App\Models\ProprieteMateriel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProprieteMaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Générer 50 propriétés de matériel
        ProprieteMateriel::factory()->count(50)->create();
    }
}
