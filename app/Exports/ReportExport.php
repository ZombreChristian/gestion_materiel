<?php

namespace App\Exports;

use App\Models\EquipmentUsage;
use Maatwebsite\Excel\Concerns\FromCollection;

class RapportExport implements FromCollection
{
    public function collection()
    {
        return EquipmentUsage::all();
    }
}
