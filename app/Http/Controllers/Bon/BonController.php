<?php

namespace App\Http\Controllers\Bon;
use App\Models\Arme;
use App\Models\StockMunition;
use App\Models\Vehicule;
use App\Models\Optique;
use App\Models\Moto;
use App\Models\Personnel;
use App\Models\StockArme;
use App\Models\StockOptique;


use App\Models\Bon;
use PDF;

use App\Models\permanence\Postegardes;
use App\Models\permanence\Moyenpostes;
use App\Models\permanence\Permanences;
use App\Models\permanence\Visiteurs;
use App\Models\permanence\Evenements;
use App\Models\Munition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;







use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BonController extends Controller
{

    public function AllBon(){

        $optiques = Optique::all();
        $munitions = Munition::all();
        $armes = Arme::all();

        $personnels = Personnel::all();
        $bon = Bon::all();



        return view('backend.bon.all_bons', compact('armes','munitions','optiques','personnels','bon'));

     }


public function StoreBon(Request $request)
{
    // Valider les données du formulaire
    $data = $request->validate([
        'personnel_id' => 'required|exists:personnels,id',
        'date' => 'required|date',
        'status' => 'required',
        'type_bon' => 'required|string',
        'armes' => 'nullable|array', // Rendre les armes optionnelles
        'quantitemunition' => 'array', // Rendre les munitions optionnelles
        'munitions' => 'array', // Rendre les munitions optionnelles
        'optiques' => 'nullable|array', // Rendre les optiques optionnelles
    ]);

    $createBon = true; // Variable pour vérifier si le bon doit être créé

    if (!empty($data['munitions'])) {
        foreach ($data['munitions'] as $key => $munitionId) {
            $quantiteMunition = $data['quantitemunition'][$key];

            // Récupérez la munition à partir de la base de données
            $munition = Munition::findOrFail($munitionId);

            // Vérifiez si la quantité disponible est suffisante
            if ($munition->quantite < $quantiteMunition) {
                // La quantité de munition n'est pas suffisante, définissez la variable $createBon sur false et arrêtez la boucle
                $createBon = false;
                break;
            } else {
                // Soustrayez la quantité utilisée de la quantité disponible
                $munition->quantite -= $quantiteMunition;
                $munition->save();
            }
        }
    }

    if ($createBon) {
        // Créez le bon uniquement si toutes les vérifications sont réussies
        $bon = Bon::create([
            'personnel_id' => $data['personnel_id'],
            'date' => $data['date'],
            'status' => $data['status'],
            'type_bon' => $data['type_bon'],
        ]);

        if (!empty($data['munitions'])) {
            foreach ($data['munitions'] as $key => $munitionId) {
                $quantiteMunition = $data['quantitemunition'][$key];
                // Associez la munition avec la quantité au bon
                $bon->munitions()->attach($munitionId, ['quantitemunition' => $quantiteMunition]);
            }
        }

        // Vérifier si des armes ont été fournies
        if (!empty($data['armes'])) {
            // Associer les armes
            $bon->armes()->attach($data['armes']);
        }

        // Vérifier si des optiques ont été fournies
        if (!empty($data['optiques'])) {
            // Associer les optiques
            $bon->optiques()->attach($data['optiques']);
        }

        // Rediriger ou afficher un message de succès
        return redirect()->route('gestionnaire.bons.all.bon')->with('success', 'Bon enregistré avec succès.');
    } else {
        // La quantité de munition n'était pas suffisante, renvoyez un message d'erreur
        return redirect()->back()->with('error', 'La quantité de munition n\'est pas suffisante. La création du bon a été annulée.');
    }
}






public function EditBon($id){

    $bons = Bon::findOrFail($id);

    $optiques = Optique::all();
        $munitions = Munition::all();
        $armes = Arme::all();

        $personnels = Personnel::all();


        return view('backend.bon.edit_bons', compact('armes','munitions','optiques','personnels','bons'));

}

public function updateBon(Request $request, $id)
{
    $bon = Bon::findOrFail($id); // Trouver le bon existant

    // Valider les données du formulaire
    $data = $request->validate([
        'personnel_id' => 'required|exists:personnels,id',
        'date' => 'required|date',
        'status' => 'required',
        'type_bon' => 'required|string',
        'armes' => 'nullable|array', // Rendre les armes optionnelles
        'quantitemunition' => 'nullable|array', // Rendre les munitions optionnelles
        'munitions' => 'nullable|array', // Rendre les munitions optionnelles
        'optiques' => 'nullable|array', // Rendre les optiques optionnelles
    ]);


    $createBon = true; // Variable pour vérifier si le bon doit être mis à jour

    if (!empty($data['munitions'])) {
        foreach ($data['munitions'] as $key => $munitionId) {
            $quantiteMunition = $data['quantitemunition'][$key];

            // Récupérez la munition à partir de la base de données
            $munition = Munition::findOrFail($munitionId);

            // Vérifiez si la quantité disponible est suffisante
            if ($munition->quantite < $quantiteMunition) {
                // La quantité de munition n'est pas suffisante, définissez la variable $createBon sur false et arrêtez la boucle
                $createBon = false;
                break;
            }
        }
    }

    if ($createBon) {
        // Mettez à jour le bon uniquement si toutes les vérifications sont réussies
        $bon->update([
            'personnel_id' => $data['personnel_id'],
            'date' => $data['date'],
            'status' => $data['status'],
            'type_bon' => $data['type_bon'],
        ]);

        // Détachez toutes les munitions associées au bon
        $bon->munitions()->detach();

        if (!empty($data['munitions'])) {
            foreach ($data['munitions'] as $key => $munitionId) {
                $quantiteMunition = $data['quantitemunition'][$key];
                // Associez la munition avec la quantité au bon
                $bon->munitions()->attach($munitionId, ['quantitemunition' => $quantiteMunition]);
            }
        }

        // Détacher toutes les armes associées au bon
        $bon->armes()->detach();

        // Vérifier si des armes ont été fournies
        if (!empty($data['armes'])) {
            // Associer les armes
            $bon->armes()->attach($data['armes']);
        }

        // Détacher toutes les optiques associées au bon
        $bon->optiques()->detach();

        // Vérifier si des optiques ont été fournies
        if (!empty($data['optiques'])) {
            // Associer les optiques
            $bon->optiques()->attach($data['optiques']);
        }

        // Rediriger ou afficher un message de succès
        return redirect()->route('gestionnaire.bons.edit.bon')->with('success', 'Bon mis à jour avec succès.');
    } else {
        // La quantité de munition n'était pas suffisante, renvoyez un message d'erreur
        return redirect()->back()->with('error', 'La quantité de munition n\'est pas suffisante. La mise à jour du bon a été annulée.');
    }
}




// public function UpdateBon(Request $request, $bonId)
// {
//     $bonId =$request->id;
//     // Valider les données du formulaire
//     $data = $request->validate([
//         'personnel_id' => 'required|exists:personnels,id',
//         'date' => 'required|date',
//         'status' => 'required|in:En cours,Validé,Rejeter',
//         'type_bon' => 'required|string',
//         'armes' => 'nullable|array',
//         'quantitemunition' => 'nullable|array',
//         'munitions' => 'nullable|array',
//         'optiques' => 'nullable|array',
//     ]);

//     // Récupérer le bon à mettre à jour
//     // $bon = Bon::findOrFail($bonId);
//     $bon = Bon::with('personnel', 'armes', 'optiques', 'munitions') // Ajoutez d'autres relations au besoin
//                 ->findOrFail($bonId);


//     // Mettre à jour les attributs du bon
//     $bon->update([
//         'personnel_id' => $data['personnel_id'],
//         'date' => $data['date'],
//         'status' => $data['status'],
//         'type_bon' => $data['type_bon'],
//     ]);

//     // Mettre à jour les relations (armes, munitions, optiques) du bon
//     if (!empty($data['armes'])) {
//         $bon->armes()->sync($data['armes']); // Synchronise la liste des armes
//     } else {
//         $bon->armes()->detach(); // Détache toutes les armes si aucune n'est fournie
//     }

//     if (!empty($data['munitions'])) {
//         $munitions = [];
//         foreach ($data['munitions'] as $key => $munitionId) {
//             $quantiteMunition = $data['quantitemunition'][$key];
//             $munitions[$munitionId] = ['quantitemunition' => $quantiteMunition];
//         }
//         $bon->munitions()->sync($munitions); // Synchronise la liste des munitions avec les quantités
//     } else {
//         $bon->munitions()->detach(); // Détache toutes les munitions si aucune n'est fournie
//     }

//     if (!empty($data['optiques'])) {
//         $bon->optiques()->sync($data['optiques']); // Synchronise la liste des optiques
//     } else {
//         $bon->optiques()->detach(); // Détache toutes les optiques si aucune n'est fournie
//     }

//     // Rediriger ou afficher un message de succès
//     return redirect()->route('gestionnaire.bons.all.bon')->with('success', 'Bon mis à jour avec succès.');
// }



public function DeleteBon($id){

    Bon:: findOrFail($id)->delete();


    $notification = array(
        'message' => ' Bon a été supprimé avec succès',
        'alert-type' => 'success'
    );


    // return redirect()->route('all.Arme')->with($notification);
    return redirect()->route('gestionnaire.bons.all.bon')->with($notification);

}

//--------------------------------------------


// public function getArmesInfo($bonId) {
//     $armesInfo = DB::table('arme_bon as ab')
//         ->join('armes as a', 'ab.arme_id', '=', 'a.id')
//         ->select('a.nom as nom_arme', DB::raw('COUNT(ab.arme_id) as nombre_occurrences'))
//         ->where('ab.bon_id', $bonId)
//         ->groupBy('a.nom')
//         ->get();

//     return response()->json($armesInfo);
// }

public function getArmesInfo($bonId)
{
    $bon = Bon::find($bonId);

    if (!$bon) {
        return response()->json(['error' => 'Bon not found'], 404);
    }

    // Récupérez les informations sur les armes associées au bon
    $armesInfo = ''; // Mettez ici les données sur les armes associées au bon sous forme d'HTML

    return response()->json($armesInfo);
}



public function telechargerPdf($id)
{
    // Récupérez le "bon" par ID (vous devrez peut-être ajuster le modèle)
    $bon = Bon::findOrFail($id);

    $armes = $bon->armes()->get();
    $munitions = $bon->munitions()->withPivot('quantitemunition')->get();
    $optiques = $bon->optiques()->get();


// Générez le contenu PDF en utilisant Laravel PDF
$pdf = PDF::loadView('bon_form', compact('bon', 'armes', 'munitions', 'optiques'));

    // Définissez le nom du fichier PDF (vous pouvez personnaliser ceci)
    $pdfFileName = 'bon_' . $bon->id . '.pdf';

    // Retournez le PDF en tant que réponse de téléchargement
    return $pdf->download($pdfFileName);
}


}
