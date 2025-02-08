<?php

namespace App\Exports;

use App\Models\Personnel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class PersonnelExport implements FromCollection
{
    use Exportable;

    public function collection()
    {

          // Utilisez des jointures pour récupérer le nom du grade, le nom de la spécialité et le libellé de la fonction
          return Personnel::join('grades', 'personnels.grade_id', '=', 'grades.id')
          ->join('specialites', 'personnels.specialite_id', '=', 'specialites.id')
          ->join('fonctions', 'personnels.fonction_id', '=', 'fonctions.id')
          ->join('groupes', 'personnels.groupe_id', '=', 'groupes.id')
          ->join('sections', 'personnels.section_id', '=', 'sections.id')
          ->join('compagnies', 'personnels.compagnie_id', '=', 'compagnies.id')

          ->select(
                
                'personnels.matricule',
                'personnels.numeroinfo',
                'personnels.nom',
                'personnels.prenom',
                'personnels.address',
                'personnels.genre',
                'personnels.situationMatrimoniale',
                'personnels.PersonnePrevenir',
                'personnels.NumeroPersonnePrevenir',
                'personnels.pseudo',
                'personnels.dateNaiss',
                'personnels.groupeSang',
                'personnels.numeroTelephone',
                'personnels.whatsappNumero',
                'personnels.status',
              'grades.nameGrade as nameGrade',
              'specialites.nomSpecialite as nomSpecialite',
              'fonctions.libelle as libelle',

              'sections.nomSection as nomSection',
              'compagnies.nomCompagnie as nomCompagnie',
              'groupes.nomGroupe as nomGroupe'
          )
          ->get();
    }
}
