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
            ['nom' => 'Ordinateur', 'utilisation' => 80, 'reservations' => 1, 'annulations' => 5, 'nombre'=>5],
            ['nom' => 'Vidéo Projecteur', 'utilisation' => 60, 'reservations' => 2, 'annulations' => 3, 'nombre'=>5],
            ['nom' => 'Imprimante', 'utilisation' => 50, 'reservations' => 1, 'annulations' => 2, 'nombre'=>5],
            ['nom' => 'Scanner', 'utilisation' => 19, 'reservations' => 1, 'annulations' => 1, 'nombre'=>5],
            ['nom' => 'Osciocope', 'utilisation' => 100, 'reservations' => 1, 'annulations' => 5,'nombre'=>5],
            ['nom' => 'brarobotique', 'utilisation' => 10, 'reservations' => 5, 'annulations' => 1, 'nombre'=>5],
            ['nom' => 'Robo', 'utilisation' => 15, 'reservations' => 11, 'annulations' => 2, 'nombre'=>5],
        ]);
    }
}

