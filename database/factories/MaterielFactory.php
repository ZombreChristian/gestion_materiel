<?php

namespace Database\Factories;


use App\Models\Materiel;
use App\Models\TypeMateriel;
use App\Models\ProprietaireMateriel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materiel>
 */
class MaterielFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->word, // Utilisez unique() pour éviter les doublons
            'imageUrl' => $this->faker->imageUrl(640, 480, 'technics', true),
            'estMutualisable' => $this->faker->boolean,
            'type_materiel_id' => TypeMateriel::factory(),
            'proprietaire_materiel_id' => ProprietaireMateriel::factory(),
            'description' => $this->faker->sentence,
            'date_acquisition' => $this->faker->date,
        ];
    }
}
