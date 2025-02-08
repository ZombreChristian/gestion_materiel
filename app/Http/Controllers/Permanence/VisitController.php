<?php

namespace App\Http\Controllers\Permanence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permanence\Visiteurs;
use App\Models\permanence\Services;
use App\Models\User;
use App\Models\Grade;

class VisitController extends Controller
{
    public function AllVisit(){
        $visiteurs = Visiteurs::latest()->get();
        $grades = Grade::all();
        $services = Services::all();
        return view('permanencier.visiteur.liste_visiteur',compact('visiteurs','services','grades'));
    }

    public function StoreVisit(Request $request){

        $request->validate([
            'vis_nom' => 'required',
            'vis_prenom' => 'required',
            'vis_genre' => 'required|in:masculin,feminin',
            'type_piece' => 'required|in:CNIB,PASSEPORT,CIM,AUTRE',
            'num_piece' => 'required',
            'vis_ser' => 'required',
            'vis_tel' => 'required',
            'aut_visiter' => 'required',
            'vis_debut' => 'required',
            'vis_fin' => 'nullable',
            'vis_date' => 'required',


        ]);


    $vis_grade = $request->vis_grade;

if ($vis_grade === 'civil') {
    // Si le grade est "civil", traitez-le comme un cas spécial
    // Créez le visiteur avec le grade "civil" ici
    Visiteurs::create([
        'vis_nom' => $request->vis_nom,
        'vis_prenom' => $request->vis_prenom,
        'vis_grade' => 'civil', // Grade "civil"
        'vis_genre' => $request->vis_genre,
        'type_piece' => $request->type_piece,
        'num_piece' => $request->num_piece,
        'vis_ser' => $request->vis_ser,
        'vis_tel' => $request->vis_tel,
        'aut_visiter' => $request->aut_visiter,
        'vis_debut' => $request->vis_debut,
        'vis_fin' => $request->vis_fin,
        'vis_date' => $request->vis_date,

    ]);
} else {
    // Sinon, créez le visiteur avec le grade sélectionné
    Visiteurs::create([
        'vis_nom' => $request->vis_nom,
        'vis_prenom' => $request->vis_prenom,
        'vis_grade' => $vis_grade, // Grade sélectionné (peut être vide)
        'vis_genre' => $request->vis_genre,
        'type_piece' => $request->type_piece,
        'num_piece' => $request->num_piece,
        'vis_ser' => $request->vis_ser,
        'vis_tel' => $request->vis_tel,
        'aut_visiter' => $request->aut_visiter,
        'vis_debut' => $request->vis_debut,
        'vis_fin' => $request->vis_fin,
        'vis_date' => $request->vis_date,

    ]);
}

        $notification = array(
            'message' => 'visiteur crée avec succès!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

}//end method

    public function DeleteVisit($id){

        Visiteurs::findOrFail($id)->delete();


        $notification = array(
            'message' => 'visiteur supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function UpdateVisit(Request $request){

        $pid = $request->id;

        // Validation
        $request->validate([
            'vis_nom' => 'required',
            'vis_prenom' => 'required',
            'vis_genre' => 'required|in:masculin,feminin',
            'type_piece' => 'required|in:CNIB,PASSEPORT,CIM,AUTRE',
            'num_piece' => 'required',
            'vis_ser' => 'required',
            'vis_tel' => 'required',
            'aut_visiter' => 'required',
            'vis_debut' => 'required',
            'vis_fin' => 'required',
            'vis_date' => 'required',
        ]);

          // Obtenez le grade
    $vis_grade = $request->vis_grade;

    // Utilisez une structure conditionnelle pour déterminer le grade à enregistrer
    $visiteursData = [
        'vis_nom' => $request->vis_nom,
        'vis_prenom' => $request->vis_prenom,
        'vis_genre' => $request->vis_genre,
        'type_piece' => $request->type_piece,
        'num_piece' => $request->num_piece,
        'vis_ser' => $request->vis_ser,
        'vis_tel' => $request->vis_tel,
        'aut_visiter' => $request->aut_visiter,
        'vis_debut' => $request->vis_debut,
        'vis_fin' => $request->vis_fin,
        'vis_date' => $request->vis_date,
    ];

    if ($vis_grade === 'civil') {
        // Si le grade est "civil", traitez-le comme un cas spécial
        $visiteursData['vis_grade'] = 'civil'; // Grade "civil"
    } else {
        // Sinon, utilisez le grade sélectionné
        $visiteursData['vis_grade'] = $vis_grade;
    }

    // Mettez à jour le visiteur
    Visiteurs::findOrFail($pid)->update($visiteursData);


        $notification = array(
            'message' => 'visiteur modifié avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('permanence.perma.all.visit')->with($notification);
    }
}
