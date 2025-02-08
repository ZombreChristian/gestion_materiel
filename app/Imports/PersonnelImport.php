<?php

namespace App\Imports;

use App\Models\Fonction;
use App\Models\Grade;
use App\Models\Groupe;
use App\Models\Specialite;
use App\Models\Personnel; // Assurez-vous d'importer le modèle Personnel
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class PersonnelImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $gradeId = isset($row[16]) ? $this->findGradeId($row[16]) : null;
            $groupeId = isset($row[19]) ? $this->findGroupeId($row[19]) : null;
            $fonctionId = isset($row[17]) ? $this->findFonctionId($row[17]) : null;
            $specialiteId = isset($row[18]) ? $this->findSpecialiteId($row[18]) : null;


            Personnel::create([
                'matricule' => $row[0], // Remplacez 1 par l'indice de la colonne que vous souhaitez importer
                'nom' => $row[2],
                'prenom' => $row[3],


                'address' => $row[7]?? null,
                'genre' => isset($row[5]) && in_array($row[5], ['masculin', 'féminin']) ? $row[5] : null,
                'situationMatrimoniale' => isset($row[6]) && in_array($row[6], ['celibataire', 'marie']) ? $row[(6)] : null,

                'PersonnePrevenir' => $row[4]?? null,
                'numeroPersonnePrevenir' => $row[8]?? null,
                'pseudo' => $row[9]?? null,
                'dateNaiss' => $row[10]?? null,
                'groupeSang' => $row[11]?? null,
                'numeroTelephone' => $row[13]?? null,
                'whatsappNumero' => $row[12]?? null,
                'numeroinfo' => $row[1]?? null,
                'grade_id' => $gradeId,
                'groupe_id' => $groupeId,
                'specialite_id' => $specialiteId,
                'fonction_id' => $fonctionId,

            ]);
        }
    }


    public function findGradeId($nameGrade)
    {
        // Implémentez la logique pour trouver l'ID du grade en fonction du nom
        // par exemple, supposons que vous ayez une table 'grades' avec une colonne 'name'
        return Grade::where('nameGrade', $nameGrade)->value('id');
    }

    public function findGroupeId($nomGroupe)
    {
        // Implémentez la logique pour trouver l'ID du groupe en fonction du nom
        // par exemple, supposons que vous ayez une table 'groupes' avec une colonne 'nom'
        return Groupe::where('nomGroupe', $nomGroupe)->value('id');
    }

    public function findFonctionId($libelle)
    {
        // Implémentez la logique pour trouver l'ID de la fonction en fonction du libellé
        // par exemple, supposons que vous ayez une table 'fonctions' avec une colonne 'libelle'
        return Fonction::where('libelle', $libelle)->value('id');
    }

    public function findSpecialiteId($nomSpecialite)
    {
        // Implémentez la logique pour trouver l'ID de la spécialité en fonction du nom
        // par exemple, supposons que vous ayez une table 'specialites' avec une colonne 'nom'
        return Specialite::where('nomSpecialite', $nomSpecialite)->value('id');
    }

}


