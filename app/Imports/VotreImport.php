<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class VotreImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
         // Traitez les données ici
         foreach ($rows as $row) {
            // $row contient les données de chaque ligne
            // Vous pouvez les traiter dynamiquement
        }
    }
}
