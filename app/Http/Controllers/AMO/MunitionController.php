<?php

namespace App\Http\Controllers\AMO;
use App\Models\Munition;
use App\Models\TypeMunition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\StockMunition;
use Illuminate\Support\Facades\DB;



class MunitionController extends Controller
{
    public function AllMunition(){
        $types_munitions = TypeMunition:: all();
        $munitions = Munition::latest()->get();
        return view('backend.munition.all_munitions',compact('munitions','types_munitions'));
     }



    public function StoreMunition(Request $request){
        // Validation
        $request->validate([
            'type' => 'required',
            // 'date' => 'required',
            'quantite' => 'required|numeric', // Assurez-vous que quantite est un nombre
        ]);

        // Vérifiez si la munition existe déjà
        $existingMunition = Munition::where('type', $request->type)->first();

        if ($existingMunition) {
            // Si la munition existe, ajoutez la nouvelle quantité à la quantité existante
            $existingMunition->quantite += $request->quantite;
            $existingMunition->save();
        } else {
            // Si la munition n'existe pas, insérez une nouvelle ligne dans la base de données
            Munition::create([
                'type' => $request->type,
                // 'date' => $request->date,
                'quantite' => $request->quantite,
            ]);
        }

        // Enregistrez le total de quantité par type de munition
        // $results = Munition::select('type', DB::raw('SUM(quantite) as total_quantite'))
        //     ->groupBy('type')
        //     ->get();

        $notification = array(
            'message' => 'Munition a été créée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('gestionnaire.munitions.all.munition')->with($notification);
    }



    public function DeleteMunition($id){

        Munition:: findOrFail($id)->delete();


        $notification = array(
            'message' => 'munition supprimé avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('gestionnaire.munitions.all.munition')->with($notification);

    }

    public function UpdateMunition(Request $request){

        $pid = $request->id;

        $request->validate([
            // 'type' => [
            //     'required',
            //     Rule::unique('munitions')->ignore($pid), // Ignorer l'ID actuel lors de la validation unique
            //     'max:200',
            // ],
            'type' => 'required|',
            // 'date' => 'required|',
            'quantite' => 'required|',
        ]);

        // Récupérer le type de munition avant la mise à jour
        $oldMunition = Munition::findOrFail($pid);
        $oldType = $oldMunition->type;

        // Mettre à jour la munition
        Munition::findOrFail($pid)->update([
            'type' => $request->type,
            // 'date' => $request->date,
            'quantite' => $request->quantite,
        ]);

        // Vérifier si le type de munition a été modifié
        if ($oldType !== $request->type) {
            // Mettre à jour la table stock_munitions

            // Calculez la somme pour l'ancien type de munition
            $oldMunitionSum = Munition::where('type', $oldType)->sum('quantite');

            // Mettez à jour le stock pour l'ancien type de munition
            StockMunition::updateOrCreate(
                ['nom_munition' => $oldType],
                ['quantite' => $oldMunitionSum]
            );

            // Calculez la somme pour le nouveau type de munition
            $newMunitionSum = Munition::where('type', $request->type)->sum('quantite');

            // Mettez à jour le stock pour le nouveau type de munition
            StockMunition::updateOrCreate(
                ['nom_munition' => $request->type],
                ['quantite' => $newMunitionSum]
            );
        }

        $notification = array(
            'message' => 'Munition modifié avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('gestionnaire.munitions.all.munition')->with($notification);
    }


    public function AllStock(){
        $stocks = StockMunition::all();
        $types_munitions = TypeMunition:: all();

        return view('backend.munition.stock_munitions',compact('stocks','types_munitions'));
     }

    //  -----------------------------------

     public function DeleteStock($id){

       StockMunition:: findOrFail($id)->delete();


        $notification = array(
            'message' => 'Stock munition a été supprimé avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('gestionnaire.munitions.all.stockMunition')->with($notification);

    }



        // ----------------------------------------------------------------------


        public function AllTypeMunition(){
            $typemunition = TypeMunition::latest()->get();
            return view('backend.typemunition.all_typemunitions',compact('typemunition'));
         }

        //  public function AddTypeArme(){
        //      return view('backend.arme.add_armes');
        //   }

         public function StoreTypeMunition(Request $request){
             // Validation
             $request->validate ([
                 'nom'=>'required|unique:type_munitions|',

             ]);

             TypeMunition:: insert([
                 'nom'=> $request->nom,


             ]);

             $notification = array(
                 'message' => 'Type Munition a été créé avec succès',
                 'alert-type' => 'success'
             );


             return redirect()->route('gestionnaire.munitions.all.typemunition')->with($notification);


         }

        //  public function EditTypeArme($id){
        //      $armes = typeArme::findOrFail($id);
        //      return view('backend.arme.edit_armes',compact('armes'));
        //   }



         public function UpdateTypeMunition(Request $request){

             $pid =$request->id;

             $request->validate ([
                'nom'=>'required|unique:type_munitions|',

             ]);


             TypeMunition:: findOrFail($pid)->update([
                 'nom'=> $request->nom,

             ]);

             $notification = array(
                 'message' => ' Type munition a été modifier avec succès',
                 'alert-type' => 'success'
             );


             return redirect()->route('gestionnaire.munitions.all.typemunition')->with($notification);


         }


         public function DeleteTypeMunition($id){

            TypeMunition:: findOrFail($id)->delete();


             $notification = array(
                 'message' => 'Type Munition a été supprimé avec succès',
                 'alert-type' => 'success'
             );
             return redirect()->route('gestionnaire.munitions.all.typemunition')->with($notification);

         }

}
