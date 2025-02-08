<?php

namespace App\Imports;

use App\Models\Arme;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithValidation;



class ArmesImport implements ToModel, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Vérifiez si la colonne 'noSerieArme' est vide ou NULL
        if (empty($row[0])) {
            // Vous pouvez ignorer cette ligne ou gérer l'erreur ici
            // Par exemple, en lançant une exception ou en enregistrant une notification d'erreur
            throw new \Exception('La colonne noSerieArme ne peut pas être vide.');
        }

        return new Arme([
            'noSerieArme' => $row[0],
            'nom' => $row[1],
            'marque' => $row[2],
            'type' => $row[3],
            'date' => $row[4],
            'etat' => $row[5],
            'provenance' => $row[6],
        ]);
    }

    /**
     * Valider les données d'importation.
     *
     * @param array $row
     * @return array
     */
    public function rules(): array
    {
        return [
            '0' => 'required', // La colonne 'noSerieArme' doit être obligatoire
            // Ajoutez d'autres règles de validation pour les autres colonnes si nécessaire
        ];
    }
}






