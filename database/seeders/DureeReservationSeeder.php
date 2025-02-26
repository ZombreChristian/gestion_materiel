<?php

namespace Database\Seeders;

use App\Models\DureeReservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DureeReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Générer 5 durées de réservation
        DureeReservation::factory()->count(5)->create();
    }
}
