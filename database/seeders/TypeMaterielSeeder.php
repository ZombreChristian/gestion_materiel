<?php

namespace Database\Seeders;

use App\Models\TypeMateriel; // Importez le modèle TypeMateriel
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeMaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Générer 10 types de matériel
       TypeMateriel::factory()->count(15)->create();
    }
}
