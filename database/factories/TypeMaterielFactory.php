<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeMateriel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeMateriel>
 */
class TypeMaterielFactory extends Factory
{
    protected $model = TypeMateriel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word, // Génère un mot aléatoire
            'description' => $this->faker->sentence, // Génère une phrase aléatoire
        ];
    }
}
