<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipement;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use resources\views\reports\index;

class ReportController extends Controller
{
    public function index()
    {
        $suggestions = Equipement::where('utilisation', '<', 20)->get();

        $equipments = Equipement::all();
        $mostUsedEquipment = Equipement::orderBy('utilisation', 'desc')->first()->nom ?? 'Aucun';

        return view('reports.index', [
            'equipements' => $equipments,
            'mostUsedEquipment' => $mostUsedEquipment,
            'suggestions' => $suggestions, 
            
        ]);
        
        
    }

    public function exportPdf()
    {
        $equipements = Equipement::all(); // Récupérer les données
        $pdf = PDF::loadView('reports.rapport_pdf', compact('equipements'));
        return $pdf->download('rapport.pdf');
    }

    public function exportExcel()
    {
        // Retourner le fichier Excel en téléchargement
        return Excel::download(new ReportExport, 'rapport.xlsx');
    }
}
