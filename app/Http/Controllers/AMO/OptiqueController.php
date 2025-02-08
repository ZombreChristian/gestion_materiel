<?php

namespace App\Http\Controllers\AMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Optique;
use App\Models\Etat;
use App\Models\Pays;

use Illuminate\Validation\Rule;


use Illuminate\Support\Facades\DB;



class OptiqueController extends Controller
{
    public function AllOptique(){
       $optiques = Optique::latest()->get();
       $etats = Etat::latest()->get();

       $pays = Pays::latest()->get();

       return view('backend.optique.all_optiques',compact('optiques','etats','pays'));
    }


     public function AllStock() {
        // Obtenir la quantité en fonction du nom d'arme
        $optiquesCountByNom = DB::table('optiques')
            ->select('type', DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();

        // Récupérez la liste des armes
        $optiques = Optique::latest()->get();

        return view('backend.optique.stock_optiques', compact('optiques', 'optiquesCountByNom'));
    }






    //  public function DeleteStock($id){

    //     StockOptique:: findOrFail($id)->delete();


    //      $notification = array(
    //          'message' => 'Stock Optique a été supprimé avec succès',
    //          'alert-type' => 'success'
    //      );
    //      return redirect()->route('all.stockOptique')->with($notification);

    //  }







public function StoreOptique(Request $request)
{
    // Validation
    $donnees = json_decode($request->input('form1'));

    // Assurez-vous que $donnees n'est pas vide avant de procéder
    if (!empty($donnees)) {
        // Tableau pour stocker les noms d'optique


        // Parcourez les données
        foreach ($donnees as $donnees1) {
            // Vérifiez si le nom d'optique existe déjà dans la table
            $existingOptique = DB::table('optiques')->where('noSerieOptique', $donnees1->noSerieOptique)->first();

            if ($existingOptique) {
                // Le nom existe déjà, renvoyez une erreur au formulaire
                $notification = array(
                    'message' => 'Le noSerieOptique d\'optique ' . $donnees1->noSerieOptique . ' existe déjà.',
                    'alert-type' => 'error'
                );

                return redirect()->route('gestionnaire.optiques.all.optique')->with($notification);
            }

            // Si le nom n'existe pas, effectuez l'insertion
            DB::table('optiques')->insert([
                'noSerieOptique' => $donnees1->noSerieOptique,
                'type' => $donnees1->type,
                'date' => $donnees1->date,
                'etat' => $donnees1->etat,
                'provenance' => $donnees1->provenance,
            ]);
        }
        $notification = array(
            'message' => 'Optique a été créée avec succès',
            'alert-type' => 'success'
        );

        // return redirect()->route('all.arme',compact('dict'))->with($notification);

        return redirect()->route('gestionnaire.optiques.all.optique')->with(['notification' => $notification]);

    } else {
        // Gérez le cas où $donnees est vide, par exemple, renvoyez une erreur ou une redirection appropriée.
        $notification = array(
            'message' => 'Aucune donnée n\'a été soumise.',
            'alert-type' => 'error'
        );

        return redirect()->route('gestionnaire.optiques.all.optique')->with($notification);
    }
}




    public function UpdateOptique(Request $request){

        $pid = $request->id;

        // Validation
        $request->validate([
            'type' => 'required|unique:optiques,type,' . $pid, // Assurez-vous d'ignorer l'optique actuelle lors de la validation unique
            'date' => 'required',
            'etat' => 'required',
            'libelle' => 'required',
        ]);

        // Mettez à jour l'optique existante
        Optique::where('id', $pid)->update([
            'etat' => $request->etat,
            'type' => $request->type,
            'date' => $request->date,
            // 'libelle'=> $request->libelle,
        ]);

        // Récupérez le type de l'optique mise à jour
        $typeOptique = $request->input('type');

        // Calculez la quantité totale en fonction du type de l'optique
        $quantite = DB::table('optiques')->where('type', $typeOptique)->count();

        // Calculez la quantité totale en fonction du type et de l'état "Bon"
        $quantiteBon = DB::table('optiques')->where('type', $typeOptique)->where('etat', 'Bon état')->count();

        // Calculez la quantité totale en fonction du type et de l'état "Mauvais état réparable"
        $quantiteMauvaisRepa = DB::table('optiques')->where('type', $typeOptique)->where('etat', 'Mauvais état réparable')->count();

        // Calculez la quantité totale en fonction du type et de l'état "Mauvais état non réparable"
        $quantiteMauvais = DB::table('optiques')->where('type', $typeOptique)->where('etat', 'Mauvais état non réparable')->count();

        // Mettez à jour la table "stock_optiques" en fonction du type de l'optique
        DB::table('stock_optiques')->updateOrInsert(
            ['type_optique' => $typeOptique],
            [
                'quantite' => $quantite,
                'quantitebon' => $quantiteBon,
                'quantitemauvaisrepa' => $quantiteMauvaisRepa,
                'quantitemauvais' => $quantiteMauvais,
            ]
        );

        $notification = [
            'message' => 'Optique a été mise à jour avec succès',
            'alert-type' => 'success',
        ];

        return redirect()->route('gestionnaire.optiques.all.optique')->with($notification);
    }





    public function DeleteOptique(Request $request){
        $pid = $request->id;

        // Récupérez l'arme avant la suppression
        $optiqueASupprimer = Optique::findOrFail($pid);
        $typeOptique = $optiqueASupprimer->type;

        // Supprimez l'arme de la table "armes"
        $optiqueASupprimer->delete();

        // Calculez la quantité totale en fonction du type de l'optique
        $quantite = DB::table('optiques')->where('type', $typeOptique)->count();

        // Calculez la quantité totale en fonction du type et de l'état "Bon"
        $quantiteBon = DB::table('optiques')->where('type', $typeOptique)->where('etat', 'Bon état')->count();

        // Calculez la quantité totale en fonction du type et de  l'état "Mauvais état réparable"
        $quantiteMauvaisRepa = DB::table('optiques')->where('type', $typeOptique)->where('etat', 'Mauvais état réparable')->count();

         // Calculez la quantité totale en fonction du type et de  l'état "Mauvais état non réparable"
         $quantiteMauvais = DB::table('optiques')->where('type', $typeOptique)->where('etat', 'Mauvais état non réparable')->count();

        // Mettez à jour la table "stock_armes" en fonction du nom de l'arme
        DB::table('stock_optiques')->updateOrInsert(
            ['type_optique' =>  $typeOptique],
            [
                'quantite' => $quantite,
                'quantitebon' => $quantiteBon,
                'quantitemauvaisrepa' => $quantiteMauvaisRepa,
                'quantitemauvais' => $quantiteMauvais,
            ]
        );

        $notification = array(
            'message' => 'L\'arme a été supprimée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('gestionnaire.optiques.all.optique')->with($notification);
    }














}
