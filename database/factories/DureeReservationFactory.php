<?php

namespace Database\Factories;

use App\Models\DureeReservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DureeReservation>
 */
class DureeReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'duree' => $this->faker->randomElement(['1 heure', '2 heures', '3 heures', '1 jour', '2 jours']),
        ];
    }
}
