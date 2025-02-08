<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\WithPagination;


use App\models\Cotisation;
use App\models\Membre;

use Illuminate\Support\Facades\DB;


class CotisationController extends Controller
{
    use WithPagination;

    // public function AllCotisation()
    // {

    //     $membres = Membre::latest()->get();
    //     $cotisations = Cotisation::latest()->get();

    //     $cotisation_semaine = Cotisation::selectRaw('membre_id, Nosemaine, SUM(lundi + mardi + mercredi + jeudi + vendredi + samedi) as montant')
    //     ->groupBy(['membre_id', 'Nosemaine'])
    //     ->get();


    //     return view('livewire.cotisations.index',compact('membres','cotisations','cotisation_semaine'));

    // }

    public function AllCotisation()
{
    $membres = Membre::latest()->get();
    // $cotisations = Cotisation::latest()->get();

        $sommes = Cotisation::selectRaw('membre_id, Nosemaine,date,lundi,mardi,mercredi,jeudi,vendredi,samedi, SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
        ->groupBy('membre_id', 'Nosemaine','date','lundi','mardi','jeudi','mercredi','vendredi','samedi')
        ->latest()
        ->paginate(5);

    return view('livewire.cotisations.index', compact('membres','sommes'));
}




public function DeleteCotisation($id){

    Cotisation:: findOrFail($id)->delete();


        $notification = array(
            'message' => 'Cotisation a été supprimé avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('admin.cotisations.all.cotisation')->with($notification);


}

public function StoreCotisation(Request $request)
{
    // Validation
    $request->validate([
        'membre_id' => 'required',
        'Nosemaine' => 'required',
        // Ajoutez d'autres règles de validation au besoin
    ]);
    // dd($request->all());
    // Recherche de l'entrée existante en fonction de membre_id et Nosemaine
    $existingCotisation = Cotisation::where('membre_id', $request->membre_id)
        ->where('Nosemaine', $request->Nosemaine)
        ->first();

    if ($existingCotisation) {
        // Vérifier si l'un des champs (lundi, mardi, etc.) a une nouvelle valeur non nulle
        $data = [];
        foreach (['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'] as $field) {
            if ($existingCotisation->$field !== null && $request->$field !== null) {
                return redirect()->back()->with('error', "La cotisation de $field a déjà été versée. Vous ne pouvez pas la mettre à jour.");
            } elseif ($request->$field !== null) {
                // Si nouvelle valeur, ajoutez-la au tableau des données
                $data[$field] = $request->$field;
            }
        }
        // Vérifiez les données à mettre à jour


        // Mettre à jour l'entrée existante avec les nouvelles valeurs
        if (!empty($data)) {
            $existingCotisation->update($data);

        }
    } else {
        // Si aucune entrée n'existe, créez une nouvelle entrée avec la somme des champs lundi à samedi
        $data = $request->only(['membre_id', 'date', 'Nosemaine', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']);
        Cotisation::create($data);


}
// ...



    $notification = [
        'message' => 'Cotisation a été créée ou mise à jour avec succès',
        'alert-type' => 'success',
    ];

    return redirect()->route('admin.cotisations.all.cotisation')->with($notification);
}



public function Semaine(Request $request)
{
    $sommes = Cotisation::selectRaw('membre_id,Nosemaine,date,SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
        ->groupBy('membre_id','Nosemaine','date')
        ->get();

    // dd($sommes);

    return view('livewire.cotisations.semaine', compact('sommes'));
}


public function SearchCotisation(Request $request){
    $search = $request->search;
    $membres = Membre::latest()->get();

    $sommes = Cotisation::selectRaw('membre_id, Nosemaine,date,lundi,mardi,mercredi,jeudi,vendredi,samedi, SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
    ->groupBy('membre_id', 'Nosemaine','date','lundi','mardi','jeudi','mercredi','vendredi','samedi')
    ->latest()
    ->paginate(5);

    $cotisations = Cotisation::with('membres')
    ->where(function($query) use ($search) {
        $query->whereHas('membres', function($query) use ($search) {
            $query->where('nom', 'like', "%$search%")
                ->orWhere('prenom', 'like', "%$search%");

        })
        ->orWhere('Nosemaine','like',"%$search%")
        ->orWhere('date','like',"%$search%");

    })

    ->paginate(5);


    // Vérifier si la recherche n'a retourné aucun résultat
    if ($cotisations->isEmpty()) {
        session()->flash('message', 'Aucun résultat trouvé pour votre recherche.');
    }

    // dd($cotisations );

    return view('livewire.cotisations.index', compact('cotisations','search','sommes','membres'));
}

public function Filter(Request $request){
    $nom = $request->nom;
    $sexe = $request->sexe;
    $prenom = $request->prenom;
    $date = $request->date;

    // $membres = Membre::latest()->get();
    // $cotisations = Cotisation::latest()->get();

        $sommes = Cotisation::selectRaw('membre_id, Nosemaine,date,lundi,mardi,mercredi,jeudi,vendredi,samedi, SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
        ->groupBy('membre_id', 'Nosemaine','date','lundi','mardi','jeudi','mercredi','vendredi','samedi')
        ->latest()
        ->paginate(5);


    $membres = Membre::where(function($query) use ($nom, $sexe, $prenom,$date){
        if ($nom) {
            $query->where('nom', 'like', "%$nom%");
        }

        if ($sexe) {
            $query->where('sexe', 'like', "%$sexe%");
        }
        if ($prenom) {
            $query->where('prenom', 'like', "%$prenom%");
        }

        if ($date) {
            $query->where('dateNaissance', 'like', "%$date%");
        }

    })
    ->paginate(5);

    // Vérifier si la recherche n'a retourné aucun résultat
    if ($membres->isEmpty()) {
        session()->flash('message', 'Aucun résultat trouvé pour votre recherche.');
    }

    // Rediriger vers l'index sans les paramètres de recherche
    return view('livewire.cotisations.index', compact('nom','sexe','membres','sommes'));
}


















}
