<?php

namespace Database\Factories;


use App\Models\Reservation;
use App\Models\Materiel;
use App\Models\User;
use App\Models\StatutReservation;
use App\Models\DureeReservation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'materiel_id' => Materiel::factory(),
            'user_id' => User::factory(),
            'statut_reservation_id' => StatutReservation::factory(),
            'duree_reservation_id' => DureeReservation::factory(),
            'date_reservation' => $this->faker->dateTime(),
            'commentaire' => $this->faker->sentence,
        ];
    }
}
