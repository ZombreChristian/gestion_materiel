<?php

namespace Database\Factories;

use App\Models\StatutReservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatutReservation>
 */
class StatutReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'statut' => $this->faker->randomElement(['En attente', 'Confirmée', 'Annulée']),
        ];
    }
}
