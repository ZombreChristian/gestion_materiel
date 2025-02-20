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
            "nom" => array_rand(["Scanners", "Projecteurs", "Imprimates", "Ordinateurs"], 1)
        ];
    }
}
