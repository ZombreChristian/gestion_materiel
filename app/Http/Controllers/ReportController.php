<?php

namespace App\Http\Controllers;

use App\Models\Equipement; // Assurez-vous que le modèle s'appelle bien Equipement
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Utilisation de l'alias Pdf
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use resources\views\reports\index;

class ReportController extends Controller
{
    /**
     * Affiche la page des rapports.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer les équipements sous-utilisés (utilisation < 20%)
        $suggestions = Equipement::where('utilisation', '<', 20)->get();

        // Récupérer tous les équipements
        $equipements = Equipement::all();

        // Récupérer l'équipement le plus utilisé
        $mostUsedEquipment = Equipement::orderBy('utilisation', 'desc')->first()->nom ?? 'Aucun';

        // Retourner la vue avec les données
        return view('reports.index', [
            'equipements' => $equipements,
            'mostUsedEquipment' => $mostUsedEquipment,
            'suggestions' => $suggestions,
        ]);


    }

    /**
     * Exporte les données en PDF.
     *
     * @return \Barryvdh\DomPDF\Facade\Pdf
     */
    public function exportPdf()
    {
        // Récupérer les équipements
        $equipements = Equipement::all();

        // Charger la vue PDF
        $pdf = Pdf::loadView('reports.rapport_pdf', compact('equipements'));

        // Options pour dompdf
        $pdf->setPaper('A4', 'landscape'); // Format A4 en mode paysage
        $pdf->setOption('isHtml5ParserEnabled', true); // Activer le parseur HTML5
        $pdf->setOption('isRemoteEnabled', true); // Activer le chargement des ressources distantes

        // Télécharger le PDF
        return $pdf->download('rapport.pdf');
    }

    /**
     * Exporte les données en Excel.
     *
     * @return \Maatwebsite\Excel\BinaryFileResponse
     */
    public function exportExcel()
    {
        // Télécharger le fichier Excel
        return Excel::download(new ReportExport, 'rapport.xlsx');
    }

    /**
     * Récupère les données des équipements pour DataTables (AJAX).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEquipmentsData(Request $request)
    {
        // Récupérer les équipements avec leur taux d'utilisation
        $equipements = Equipement::select('nom', 'utilisation')->get();

        // Formater les données pour DataTables
        $data = $equipements->map(function ($equipement) {
            return [
                'nom' => $equipement->nom,
                'utilisation' => $equipement->utilisation,
            ];
        });

        // Renvoyer les données au format JSON
        return response()->json(['data' => $data]);
    }
}

