<?php

namespace Database\Seeders;

use App\Models\StatutReservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatutReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatutReservation::factory()->count(3)->create();
    }
}
