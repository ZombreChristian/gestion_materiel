<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PDF;
use App\Models\Cotisation;

class PdfgenerateController extends Controller
{
    public function telechargerPdf(Request $request)
{

    $pid =$request->id;

    // Récupérez le "bon" par ID (vous devrez peut-être ajuster le modèle)
    $paiement = Cotisation::findOrFail($pid);

    $resultats = Cotisation::selectRaw('membre_id, SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
        ->groupBy('membre_id')
        ->get();

// Générez le contenu PDF en utilisant Laravel PDF
$pdf = PDF::loadView('bon_form', compact('paiement', 'resultats'));

    // Définissez le nom du fichier PDF (vous pouvez personnaliser ceci)
    $pdfFileName = 'paiement_' . $paiement->id . '.pdf';

    // Retournez le PDF en tant que réponse de téléchargement
    return $pdf->download($pdfFileName);
}

}
