<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membre>
 */
class MembreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array


    {
        $nationalites = ['Française', 'Américaine', 'Allemande', 'Burkinabè', 'Espagnole', 'Togolaise', 'Chinoise', 'Russe'];
        // Sélection aléatoire d'une nationalité
        $nationaliteAleatoire = $nationalites[array_rand($nationalites)];
        return [

            'nom' => fake()->name(),
            'prenom' => fake()->firstName(),
            'dateNaissance' => fake()->date(),
            'lieuNaissance' => fake()->city(),
            'nationalite' => $nationaliteAleatoire,
            'ville' => fake()->city(),
            'pays' => fake()->country(),
            'email' => fake()->unique()->safeEmail(),
            'telephone1' => fake()->phoneNumber,
            'telephone2' => fake()->phoneNumber,
            'adresse' => fake()->address,

            // 'montant' => fake()->numberBetween($min = 100000, $max = 10000000),

          //  'montant' => fake()->numberBetween($min = 100000, $max = 10000000),

            'noPieceIdentite' => fake()->regexify('[A-Za-z0-9]{8}'), // Génère une combinaison de 8 caractères alphanumériques            'montant' => fake()->numberBetween($min = 100000, $max = 10000000),            'photo' => fake()->imageUrl('60','60'),
            'sexe' => fake()->randomElement(['M','F']),
            'pieceIdentite' => fake()->randomElement(['CNIB','PASSPORT','PERMIS DE CONDUIRE']),
        ];
    }
}
