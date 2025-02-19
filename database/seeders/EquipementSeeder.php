<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipement;

class EquipementSeeder extends Seeder
{
    public function run()
    {
        Equipement::insert([
            ['nom' => 'Ordinateur', 'utilisation' => 80, 'reservations' => 50, 'annulations' => 5],
            ['nom' => 'Vidéo Projecteur', 'utilisation' => 60, 'reservations' => 30, 'annulations' => 3],
            ['nom' => 'Imprimante', 'utilisation' => 50, 'reservations' => 20, 'annulations' => 2],
            ['nom' => 'Scanner', 'utilisation' => 40, 'reservations' => 15, 'annulations' => 1],
            ['nom' => 'Osciocope', 'utilisation' => 100, 'reservations' => 10, 'annulations' => 5],
        ]);
    }
}

