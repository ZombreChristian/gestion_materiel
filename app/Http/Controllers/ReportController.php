<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    public function generate()
    {
        return view('reports.generate', [
            'title' => 'Générer un rapport',
        ]);
    }

    public function exportPdf()
    {
        // Logique pour récupérer les données nécessaires pour le rapport
        $data = [
            // Exemple de données, remplace-les par les données réelles
            'reportData' => 'Ceci est un exemple de données de rapport.',
        ];

        // Générer le PDF avec la vue
        $pdf = PDF::loadView('rapport.pdf', $data);

        // Télécharger le fichier PDF
        return $pdf->download('rapport.pdf');
    }

    public function exportExcel()
    {
        // Retourner le fichier Excel en téléchargement
        return Excel::download(new ReportExport, 'rapport.xlsx');
    }
}
