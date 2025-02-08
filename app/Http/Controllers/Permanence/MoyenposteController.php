<?php

namespace App\Http\Controllers\Permanence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permanence\Moyenpostes;

class MoyenposteController extends Controller
{
      public function AllMoyen(){
        $moyenpostes = Moyenpostes::latest()->get();
        return view('permanencier.moyen.moyen_poste',compact('moyenpostes'));
    }

    public function StoreMoyen(Request $request){

        $request->validate([
            'moy_serie' => 'nullable',
            'moy_libelle' => 'required',
            'moy_modele' => 'nullable',
            'moy_origine' => 'nullable',
            'moy_etat' => 'nullable|in:bon,mauvais,neuf,panne,disponible,indisponible',
            'moy_nbre' => 'nullable',
            'moy_observ' => 'nullable',

        ]);

        Moyenpostes::create([
            'moy_serie' => $request->moy_serie,
            'moy_libelle' => $request->moy_libelle,
            'moy_modele' => $request->moy_modele,
            'moy_origine' => $request->moy_origine,
            'moy_nbre' => $request->moy_nbre,
            'moy_etat' => $request->moy_etat,
            'moy_observ' => $request->moy_observ,
             

        ]);

        $notification = array(
            'message' => 'moyen poste crée avec succès!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
}//end method

    public function DeleteMoyen($id){

        Moyenpostes::findOrFail($id)->delete();


        $notification = array(
            'message' => 'service supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
}

public function UpdateMoyen(Request $request){
    $pid =$request->id;
    // Validation
    $request->validate ([
        'moy_serie' => 'required',
        'moy_libelle' => 'required',
        'moy_modele' => 'required',
        'moy_origine' => 'required',
        'moy_etat' => 'required|in:bon,mauvais,neuf,panne,disponible,indisponible',
        'moy_nbre' => 'required',
        'moy_observ' => 'required',

    ]);

    Moyenpostes:: findOrFail($pid)->update([
        'moy_serie' => $request->moy_serie,
        'moy_libelle' => $request->moy_libelle,
        'moy_modele' => $request->moy_modele,
        'moy_origine' => $request->moy_origine,
        'moy_etat' => $request->moy_etat,
        'moy_nbre' => $request->moy_nbre,
        'moy_observ' => $request->moy_observ,
    ]);

    $notification = array(
        'message' => 'Moyen Poste modifié avec succès',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}

}