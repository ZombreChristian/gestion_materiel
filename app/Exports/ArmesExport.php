<?php

namespace App\Exports;

use App\Models\Arme;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArmesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Arme::select('noSerieArme','nom','marque','type','date','etat','provenance')->get();
    }
}
