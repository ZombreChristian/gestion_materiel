<?php

namespace App\Http\Controllers\AMO;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\StockMunition; // J'ai supposé que le modèle se trouve dans le dossier "Models".

class StockMunitionController extends Controller{

    public function AllStockMunition(){
        $munitions = StockMunition::all();
        return view('backend.stockMunition.all_stockMunitions', compact('munitions'));
    }

    public function StoreStockMunition(Request $request){

        // Validation
        $request->validate ([
            'type_munition'=>'required|',
            'nombre_caisse'=>'required|',
            'nombre_boite'=>'required|',
            'quantite_boite'=>'required|',
            'date'=>'required|',


        ]);

        $typeMunition = $request->input('type_munition');
        $nombreCaisse = $request->input('nombre_caisse');
        $nombreBoite = $request->input('nombre_boite');
        $quantiteBoite = $request->input('quantite_boite');
        $date = $request->input('date');



        // Calcul de la quantité totale
        $quantite = $nombreCaisse * $nombreBoite * $quantiteBoite;

        // Enregistrement dans la table
        StockMunition::create([
            'type_munition' => $typeMunition,
            'nombre_caisse' => $nombreCaisse,
            'nombre_boite' => $nombreBoite,
            'quantite_boite' => $quantiteBoite,
            'date' => $date,
            'quantite' => $quantite,
        ]);



        $notification = array(
            'message' => 'Munition a été créé avec succès',
            'alert-type' => 'success'
        );


        return redirect()->route('all.stockMunition')->with($notification);


    }


    public function UpdateMunition(Request $request){

        $pid =$request->id;

        $request->validate ([

            'type_munition'=>'required|',
            'nombre_caisse'=>'required|',
            'nombre_boite'=>'required|',
            'quantite_boite'=>'required|',
            'date'=>'required|',
        ]);

        $typeMunition = $request->input('type_munition');
        $nombreCaisse = $request->input('nombre_caisse');
        $nombreBoite = $request->input('nombre_boite');
        $quantiteBoite = $request->input('quantite_boite');
        $date = $request->input('date');



        // Calcul de la quantité totale
        $quantite = $nombreCaisse * $nombreBoite * $quantiteBoite;


        StockMunition:: findOrFail($pid)->update([
            'type_munition' => $typeMunition,
            'nombre_caisse' => $nombreCaisse,
            'nombre_boite' => $nombreBoite,
            'quantite_boite' => $quantiteBoite,
            'date' => $date,
            'quantite' => $quantite,

        ]);

        $notification = array(
            'message' => 'Munition modifié avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('gestionnaire.munitions.all.stockMunition')->with($notification);


    }


    public function DeleteStockMunition($id){

        StockMunition:: findOrFail($id)->delete();


        $notification = array(
            'message' => 'munition supprimé avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('gestionnaire.munitions.all.stockMunition')->with($notification);

    }
}
