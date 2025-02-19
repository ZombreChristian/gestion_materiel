<?php

namespace App\Exports;

use App\Models\Equipement;
use App\Exports\EquipementsExport;
use Maatwebsite\Excel\Concerns\FromCollection;

class EquipementsExport implements FromCollection
{
    public function collection()
    {
        return Equipement::select('nom', 'utilisation')->get();
    }
}
