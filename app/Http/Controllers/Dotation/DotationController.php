<?php

namespace App\Http\Controllers\Dotation;
use App\Models\Arme;

use App\Models\StockArme;

use App\Models\StockOptique;

use App\Models\Munition;
use App\Models\Vehicule;
use App\Models\Optique;
use App\Models\ArmeDotation;
use App\Models\Personnel;
use App\Models\Dotation;
use App\Models\Bon;
use App\Events\DotationCreated;
use PDF;
use Illuminate\Support\Facades\DB;





use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DotationController extends Controller
{
    public function AllDotation(){

        $personnels = Personnel::all();
        $dotations = Dotation::all();
        // $bon = Bon::all();
        // $armes =  Arme::where('actif', 1)->latest()->get();

        $armes = Arme::where('actif', 1)->where('archiver', 1)->latest()->get();
        // $munitions = Munition::all();
        // $optiques = Optique::all();


        return view('backend.dotation.all_dotations', compact('personnels', 'armes','dotations'));

     }


//      public function obtenirArmesPourDotation($dotationId)
// {
//     $dotation = Dotation::find($dotationId);

//     if ($dotation) {
//         $armes = $dotation->armes;
//         // Faites quelque chose avec les armes, par exemple, les renvoyer à une vue.
//         return view('votre_vue', ['armes' => $armes]);
//     } else {
//         // Gérez le cas où la dotation n'a pas été trouvée.
//     }
// }

public function StoreDotation(Request $request)
{
    // Valider les données du formulaire
    $data = $request->validate([
        'personnel_id' => 'required|exists:personnels,id',
        'arme_id' => 'required',
        'date_dotation' => 'required|date',
        'motif_dotation' => 'required|string',
        'date_reintegration' => 'required|date',

    ]);


    // Créer une nouvelle dotation
    $dotation = Dotation::create([
        'personnel_id' => $data['personnel_id'],
        'arme_id' => $data['arme_id'],
        'date_dotation' => $data['date_dotation'],
        'date_reintegration' => $data['date_reintegration'],
        'motif_dotation' => $data['motif_dotation'],
    ]);

    DB::update("UPDATE armes SET actif = 0 WHERE id IN (SELECT arme_id FROM dotations)");

    // Rediriger ou afficher un message de succès
    return redirect()->route('gestionnaire.dotations.all.dotation')->with('success', 'Dotation enregistré avec succès.');
}

// --------------


public function updateDotation(Request $request, $id)
{
    // Validez les données du formulaire ici
    $data = $request->validate([
        'personnel' => 'required|exists:personnels,id',
        'status' => 'required|',
        'armes' => 'array',
        'munitions' => 'array',
        'optiques' => 'array',
        'quantitearme' => 'array',
        'quantiteoptique' => 'array',
        'quantitemunition' => 'array',
        'date' => 'required|date', // Utilisez la règle 'date' pour valider la date
        'type_dotation' => 'required', //

    ]);


    // Trouvez le dotation de mission que vous souhaitez mettre à jour
    $dotation = Dotation::findOrFail($id);

    // Mettez à jour les attributs du dotation de mission
    $dotation->personnel_id = $data['personnel'];

    $dotation->type_dotation =$request->type_dotation;
    $dotation->date =$request->date;
    $dotation->status =$request->status;


    foreach ($data['armes'] as $index => $armeId) {
        $dotation->armes()->sync($armeId, ['quantitearme' => $data['quantitearme'][$index]]);
    }

    foreach ($data['optiques'] as $index => $optiqueId) {
        $dotation->optiques()->sync($optiqueId, ['quantiteoptique' => $data['quantiteoptique'][$index]]);
    }

    // Attachez les munitions au dotation en utilisant la méthode attach
    foreach ($data['munitions'] as $index => $munitionId) {
        $dotation->munitions()->sync($munitionId, ['quantitemunition' => $data['quantitemunition'][$index]]);
    }



    $dotation->save();



    $notification = array(
        'message' => 'Dotation a été mis à jour avec succès',
        'alert-type' => 'success'
    );

    return redirect()->route('gestionnaire.dotations.all.dotation')->with($notification);
}


public function DeleteDotation($id){
    Dotation:: findOrFail($id)->delete();
    $notification = array(
        'message' => ' Dotation a été supprimé avec succès',
        'alert-type' => 'success'
    );


    // return redirect()->route('all.Arme')->with($notification);
    return redirect()->route('gestionnaire.dotations.all.dotation')->with($notification);

}

public function telechargerPdf($id)
{
    // Récupérez le "dotation" par ID (vous devrez peut-être ajuster le modèle)
    $dotation = Dotation::findOrFail($id);

    $armes = $dotation->armes()->get();


// Générez le contenu PDF en utilisant Laravel PDF
$pdf = PDF::loadView('dotation_form', compact('dotation', 'armes'));

    // Définissez le nom du fichier PDF (vous pouvez personnaliser ceci)
    $pdfFileName = 'dotation_' . $dotation->id . '.pdf';

    // Retournez le PDF en tant que réponse de téléchargement
    return $pdf->download($pdfFileName);
}




}
