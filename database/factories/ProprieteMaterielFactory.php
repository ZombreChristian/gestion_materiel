<?php

namespace Database\Factories;


use App\Models\ProprieteMateriel;
use App\Models\Materiel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProprieteMateriel>
 */
class ProprieteMaterielFactory extends Factory
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
            'propriete' => $this->faker->word,
            'valeur' => $this->faker->word,
        ];
    }
}
