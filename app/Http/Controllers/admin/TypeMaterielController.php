<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Membre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class TypeMaterielController extends Controller
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function AllEtudiant(){

        Carbon::setLocale("fr");
        $types = Membre::latest()->paginate(25);



        return view('livewire.typeMateriel.index', compact('types'));

     }

    // public function Search(Request $request){
    //     $search= $request->search;
    //     $Etudiants= Etudiant::where(function($query) use ($search){
    //         $query->where('nom','like',"%$search%")
    //         ->orwhere('prenom','like',"%$search%")
    //         ->orwhere('sexe','like',"%$search%")
    //         ->orwhere('dateNaissance','like',"%$search%");


    //     })

    //     // ->orwhereHas('category',function($query) use ($search){
    //     //     $query->where('name','like',"%$search%");
    //     // })
    //     ->paginate(5);
    //     return view('livewire.Etudiants.index', compact('Etudiants','search'));


    // }

    public function Search(Request $request){
        $search = $request->search;
        $Etudiants = Etudiant::where(function($query) use ($search){
            $query->where('nom','like',"%$search%")
                ->orWhere('prenom','like',"%$search%")
                ->orWhere('sexe','like',"%$search%")
                ->orWhere('dateNaissance','like',"%$search%");
        })
        ->paginate(20);

        // Vérifier si la recherche n'a retourné aucun résultat
        if ($Etudiants->isEmpty()) {
            session()->flash('message', 'Aucun résultat trouvé pour votre recherche.');
        }

        return view('livewire.Etudiants.index', compact('Etudiants','search'));
    }

    public function Filter(Request $request){
        $nom = $request->nom;
        $sexe = $request->sexe;
        $prenom = $request->prenom;
        $dateNaissance = $request->dateNaissance;
        $telephone1 = $request->telephone1;

        $Etudiants = Etudiant::where(function($query) use ($nom, $sexe, $prenom,$dateNaissance,$telephone1){
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
        if ($Etudiants->isEmpty()) {
            session()->flash('message', 'Aucun résultat trouvé pour votre recherche.');
        }

        // Rediriger vers l'index sans les paramètres de recherche
        return view('livewire.Etudiants.index', compact('nom','sexe','Etudiants'));
    }







    //  public function AddEtudiant(){
    //     return view('backend.Etudiant.add_Etudiants');
    //  }

     public function StoreEtudiant(Request $request){
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



        Etudiant:: insert([
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
            'message' => 'Etudiant a été créé avec succès',
            'alert-type' => 'success'
        );


        return redirect()->route('admin.Etudiants.all.Etudiant')->with($notification);


    }

    // public function EditEtudiant($id){
    //     $Etudiants = Etudiant::findOrFail($id);
    //     return view('backend.Etudiant.edit_Etudiants',compact('Etudiants'));
    //  }

     public function UpdateEtudiant(Request $request){

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


        Etudiant::findOrFail($pid)->update([
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
            'message' => 'Etudiant a été modifié avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('admin.Etudiants.all.Etudiant')->with($notification);


    }

    public function DeleteEtudiant($id){

        Etudiant:: findOrFail($id)->delete();


        $notification = array(
            'message' => 'Etudiant a été supprimé avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('admin.Etudiants.all.Etudiant')->with($notification);

    }
}
