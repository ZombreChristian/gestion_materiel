<?php

namespace App\Http\Controllers\AMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arme;
use App\Models\Pays;


use App\Models\Etat;

use App\Models\StockArme;

use App\Models\TypeArme;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Imports\ArmesImport;
use App\Exports\ArmesExport;

use Maatwebsite\Excel\Facades\Excel;


use App\Models\permanence\Postegardes;
use App\Models\permanence\Moyenpostes;
use App\Models\permanence\Permanences;
use App\Models\permanence\Visiteurs;
use App\Models\permanence\Evenements;
use App\Models\Munition;
use App\Models\Personnel;
use Carbon\Carbon;




class ArmeController extends Controller

{


public function AllArme(){
    $armes = Arme::where('actif', 1)->where('archiver', 1)->latest()->get();
       $types_armes = TypeArme:: all();
       $etats = Etat::latest()->get();
       $pays = Pays::latest()->get();


    //    $stock_armes = StockArme:: all();
       return view('backend.arme.all_armes',compact('armes','types_armes','etats','pays'));
    }

    public function AllArmes(){
        $armes = Arme::where('actif', 1)->where('archiver', 1)->latest()->get();
           $types_armes = TypeArme:: all();
           $etats = Etat::latest()->get();
           $pays = Pays::latest()->get();


        //    $stock_armes = StockArme:: all();
           return view('backend.arme.test',compact('armes','types_armes','etats','pays'));
        }





    // public function AddArme(){


    //     $types_armes = TypeArme:: all();
    //    $etats = Etat::latest()->get();

    //    $pays = Pays::latest()->get();
    //     $munitions = Munition::all();
    //     $armes = Arme::all();

    //     $personnels = Personnel::all();
    //     return view('backend.arme.edit_armes',compact('armes','munitions','personnels','types_armes','etats','pays'));

    // }


    //  -----------------------------------



public function StoreArme(Request $request)
{
    // Validation
    $donnees = json_decode($request->input('form1'));

    // Assurez-vous que $donnees n'est pas vide avant de procéder
    if (!empty($donnees)) {
        // Tableau pour stocker les noms d'armes


        // Parcourez les données
        foreach ($donnees as $donnees1) {
            // Vérifiez si le nom d'arme existe déjà dans la table
            $existingArme = DB::table('armes')->where('noSerieArme', $donnees1->noSerieArme)->first();

            if ($existingArme) {
                // Le nom existe déjà, renvoyez une erreur au formulaire
                $notification = array(
                    'message' => 'Le noSerieArme d\'arme ' . $donnees1->noSerieArme . ' existe déjà.',
                    'alert-type' => 'error'
                );

                return redirect()->route('gestionnaire.armes.all.arme')->with($notification);
            }

            // Si le nom n'existe pas, effectuez l'insertion
            DB::table('armes')->insert([
                'noSerieArme' => $donnees1->noSerieArme,
                'nom' => $donnees1->nom,
                'marque' => $donnees1->marque,
                'type' => $donnees1->type,
                'date' => $donnees1->date,
                'etat' => $donnees1->etat,
                'provenance' => $donnees1->provenance,
            ]);
        }
        $notification = array(
            'message' => 'Arme a été créée avec succès',
            'alert-type' => 'success'
        );

        // return redirect()->route('all.arme',compact('dict'))->with($notification);

        return redirect()->route('gestionnaire.armes.all.arme')->with('success', 'Le nom d\'arme ' . $donnees1->nom . ' a été créé avec succès.');

    } else {
        // Gérez le cas où $donnees est vide, par exemple, renvoyez une erreur ou une redirection appropriée.
        $notification = array(
            'message' => 'Aucune donnée n\'a été soumise.',
            'alert-type' => 'error'
        );

        return redirect()->route('gestionnaire.armes.all.arme')->with($notification);
    }
}

// ------------------------------------
// public function rechercheArmes(Request $request)
//     {
//         $searchTerm = $request->input('searchTerm');

//         $resultats = Arme::where('nom', 'like', '%' . $searchTerm . '%')->get();

//         return response()->json($resultats);
//     }

    //



// public function AllStock()
// {
//     // Obtenir la quantité en fonction du nom d'arme pour les armes actives (actif = 1)
//     $armesCountByNom = DB::table('armes')
//         ->select('nom', DB::raw('COUNT(*) as count'))
//         ->where('actif', 1)
//         ->groupBy('nom')
//         ->get();

//     // Récupérez la liste des armes actives
//     $armes = Arme::where('actif', 1)->latest()->get();

//     return view('backend.arme.stock_armes', compact('armes', 'armesCountByNom'));
// }

public function AllStock()
{
    // Seuil pour l'alerte
    $seuilAlerte = 3; // Mettez ici votre seuil d'alerte

    // Obtenir la quantité en fonction du nom d'arme pour les armes actives (actif = 1)
    $armesCountByNom = DB::table('armes')
        ->select('nom', DB::raw('COUNT(*) as count'))
        ->where('actif', 1)
        ->groupBy('nom')
        ->get();

    // Vérifier si la quantité dépasse le seuil d'alerte et ajouter un drapeau d'alerte
    foreach ($armesCountByNom as $count) {
        if ($count->count > $seuilAlerte) {
            $count->alerte = true;
        } else {
            $count->alerte = false;
        }
    }

    // Récupérez la liste des armes actives
    $armes = Arme::where('actif', 1)->latest()->get();

    return view('backend.arme.stock_armes', compact('armes', 'armesCountByNom'));
}




public function AllStockDote(){
    $armes =  Arme::where('actif', 0)->latest()->get();

       return view('backend.arme.armes_dotes',compact('armes'));

}


public function Reintegre($id) {
    // Récupérez l'arme par son ID
    $arme = Arme::findOrFail($id);
    // Mettez à jour l'état de l'arme à 1
    $arme->update(['actif' => 1]);

    $notification = [
        'message' => 'Arme a été réintégrée avec succès',
        'alert-type' => 'success'
    ];

    return redirect()->route('gestionnaire.armes.all.arme')->with($notification);
}

public function Archiver($id) {
    // Récupérez l'arme par son ID
    $arme = Arme::findOrFail($id);
    // Mettez à jour l'état de l'arme à 1
    $arme->update(['archiver' => 0]);

    $notification = [
        'message' => 'Arme a été archivé avec succès',
        'alert-type' => 'success'
    ];

    return redirect()->route('gestionnaire.armes.all.arme')->with($notification);
}









    public function UpdateArme(Request $request){
        $pid = $request->id;


        // Mise à jour de l'arme avec l'ID $id
        $arme = Arme::findOrFail($pid);

        $arme->update([
            'noSerieArme' =>$request->noSerieArme,
            'nom' => $request->nom,
            'marque' => $request->marque,
            'type' => $request->type,
            'date' => $request->date,
            'etat' => $request->etat,
            'provenance' => $request->provenance,
        ]);



        $notification = array(
            'message' => 'Arme a été mise à jour avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('gestionnaire.armes.all.arme')->with($notification);

}



    public function DeleteArme(Request $request){
        $pid = $request->id;

        // Récupérez l'arme avant la suppression
        $armeASupprimer = Arme::findOrFail($pid);
        $nomArme = $armeASupprimer->nom;

        // Supprimez l'arme de la table "armes"
        $armeASupprimer->delete();


        $notification = array(
            'message' => 'L\'arme a été supprimée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('gestionnaire.armes.all.arme')->with($notification);
    }


    // ----------------------------------------------------------------------


    public function AllTypeArme(){
        $typearme = TypeArme::latest()->get();
        return view('backend.typearme.all_typearmes',compact('typearme'));
     }

     public function StoreTypeArme(Request $request){
         // Validation
         $request->validate ([
             'nom'=>'required|unique:type_armes|',

         ]);

         TypeArme:: insert([
             'nom'=> $request->nom,


         ]);

         $notification = array(
             'message' => 'Type Arme a été créé avec succès',
             'alert-type' => 'success'
         );


         return redirect()->route('gestionnaire.armes.all.typearme')->with($notification);


     }

     public function UpdateTypeArme(Request $request){

         $pid =$request->id;

         $request->validate ([
            'nom'=>'required|unique:type_armes|',

         ]);


         TypeArme:: findOrFail($pid)->update([
             'nom'=> $request->nom,

         ]);

         $notification = array(
             'message' => ' Arme a été modifier avec succès',
             'alert-type' => 'success'
         );


         return redirect()->route('gestionnaire.armes.all.typearme')->with($notification);


     }


     public function DeleteTypeArme($id){

         TypeArme:: findOrFail($id)->delete();


         $notification = array(
             'message' => 'Type Arme a été supprimé avec succès',
             'alert-type' => 'success'
         );
         return redirect()->route('gestionnaire.armes.all.typearme')->with($notification);

     }


public function getNomsArmes(Request $request)
{
    $selectedArme = $request->input('selected_arme');

    // Effectuez une requête pour récupérer les noms d'armes correspondants en utilisant une jointure
    $nomsArmes = DB::table('stock_armes')
        ->join('armes', 'stock_armes.nom_arme', '=', 'armes.nom')
        ->where('stock_armes.nom_arme', $selectedArme)
        ->pluck('armes.nom');

    // Retournez les noms d'armes sous forme de JSON
    return response()->json($nomsArmes);
}



public function ImportListeArme(){
    return view('backend.arme.import_listeArmes');
}

// importer une liste d'armes

public function Import(Request $request){
    Excel::import(new ArmesImport, $request->file('import_file'));

    $notification = array(
        'message' => 'Armes Import Successfully',
        'alert-type' => 'success'
    );


    // return redirect()->route('all.type')->with($notification);
    return redirect()->route('gestionnaire.armes.all.arme')->with($notification);


}

public function Export(){
    return Excel::download(new ArmesExport, 'armes.xlsx');


}











}
