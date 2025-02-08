<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Membre;
use Illuminate\Support\Facades\DB;



class MembreController extends Controller
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function AllMembre(){

        Carbon::setLocale("fr");
        $membres = Membre::latest()->paginate(25);



        return view('livewire.membres.index', compact('membres'));

     }

    // public function Search(Request $request){
    //     $search= $request->search;
    //     $membres= Membre::where(function($query) use ($search){
    //         $query->where('nom','like',"%$search%")
    //         ->orwhere('prenom','like',"%$search%")
    //         ->orwhere('sexe','like',"%$search%")
    //         ->orwhere('dateNaissance','like',"%$search%");


    //     })

    //     // ->orwhereHas('category',function($query) use ($search){
    //     //     $query->where('name','like',"%$search%");
    //     // })
    //     ->paginate(5);
    //     return view('livewire.membres.index', compact('membres','search'));


    // }

    public function Search(Request $request){
        $search = $request->search;
        $membres = Membre::where(function($query) use ($search){
            $query->where('nom','like',"%$search%")
                ->orWhere('prenom','like',"%$search%")
                ->orWhere('sexe','like',"%$search%")
                ->orWhere('dateNaissance','like',"%$search%");
        })
        ->paginate(20);

        // Vérifier si la recherche n'a retourné aucun résultat
        if ($membres->isEmpty()) {
            session()->flash('message', 'Aucun résultat trouvé pour votre recherche.');
        }

        return view('livewire.membres.index', compact('membres','search'));
    }

    public function Filter(Request $request){
        $nom = $request->nom;
        $sexe = $request->sexe;
        $prenom = $request->prenom;
        $dateNaissance = $request->dateNaissance;
        $telephone1 = $request->telephone1;

        $membres = Membre::where(function($query) use ($nom, $sexe, $prenom,$dateNaissance,$telephone1){
            if ($nom) {
                $query->where('nom', 'like', "%$nom%");
            }

            if ($sexe) {
                $query->where('sexe', 'like', "%$sexe%");
            }
            if ($prenom) {
                $query->where('prenom', 'like', "%$prenom%");
            }

            if ($dateNaissance) {
                $query->where('dateNaissance', 'like', "%$dateNaissance%");
            }
            if ($telephone1) {
                $query->where('telephone1', 'like', "%$telephone1%");
            }
        })
        ->paginate(20);

        // Vérifier si la recherche n'a retourné aucun résultat
        if ($membres->isEmpty()) {
            session()->flash('message', 'Aucun résultat trouvé pour votre recherche.');
        }

        // Rediriger vers l'index sans les paramètres de recherche
        return view('livewire.membres.index', compact('nom','sexe','membres'));
    }







    //  public function AddMembre(){
    //     return view('backend.membre.add_Membres');
    //  }

     public function StoreMembre(Request $request){
        // Validation
        $request->validate ([


            'nom'=>'required',
            'prenom'=>'required',
            'sexe'=>'required',
            'pieceIdentite'=>'required',
            'noPieceIdentite'=>'required',
            'telephone1'=>'required',
            'pays'=>'required',

            'dateNaissance'=>'required',
            'ville'=>'required',
            'lieuNaissance'=>'required',
            'adresse'=>'required',
            'montant'=>'required',

            // 'password'=>'required',


        ]);



        Membre:: insert([
        'nom'=> $request->nom,
        'prenom'=> $request->prenom,
        'sexe'=> $request->sexe,
        'dateNaissance'=> $request->dateNaissance,
        'lieuNaissance'=> $request->lieuNaissance,
        'nationalite'=> $request->nationalite,
        'ville'=> $request->ville,
        'pays'=> $request->pays,
        'pieceIdentite'=> $request->pieceIdentite,
        'adresse'=> $request->adresse,
        'noPieceIdentite'=>$request->noPieceIdentite,
        'telephone1'=> $request->telephone1,
        'telephone2'=> $request->telephone2,
        'email'=> $request->email,
        'montant'=> $request->montant,

        // 'password'=> $request->password,



        ]);


        $notification = array(
            'message' => 'membre a été créé avec succès',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.membres.all.membre')->with($notification);


    }

    // public function EditMembre($id){
    //     $Membres = Membre::findOrFail($id);
    //     return view('backend.Membre.edit_Membres',compact('Membres'));
    //  }

     public function UpdateMembre(Request $request){

        $pid =$request->id;

        $request->validate ([

            'nom'=>'required',
            'prenom'=>'required',
            'sexe'=>'required',
            'pieceIdentite'=>'required',
            'noPieceIdentite'=>'required',
            'telephone1'=>'required',
            'pays'=>'required',

            'dateNaissance'=>'required',
            'ville'=>'required',
            'lieuNaissance'=>'required',
            'adresse'=>'required',
            'montant'=>'required',

        ]);


        Membre::findOrFail($pid)->update([
            'nom'=> $request->nom,
            'prenom'=> $request->prenom,
            'sexe'=> $request->sexe,
            'dateNaissance'=> $request->dateNaissance,
            'lieuNaissance'=> $request->lieuNaissance,
            'nationalite'=> $request->nationalite,
            'ville'=> $request->ville,
            'pays'=> $request->pays,
            'pieceIdentite'=> $request->pieceIdentite,
            'adresse'=> $request->adresse,
            'noPieceIdentite'=>$request->noPieceIdentite,
            'telephone1'=> $request->telephone1,
            'telephone2'=> $request->telephone2,
            'email'=> $request->email,
            'montant'=> $request->montant,

        ]);

        $notification = array(
            'message' => 'Membre a été modifié avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('admin.membres.all.membre')->with($notification);


    }

    public function DeleteMembre($id){

        Membre:: findOrFail($id)->delete();


        $notification = array(
            'message' => 'Membre a été supprimé avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('admin.membres.all.membre')->with($notification);

    }
}
