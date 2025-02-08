<?php

namespace App\Http\Controllers\Permanence;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permanence\Postegardes;
use App\Models\permanence\Moyenpostes;
use App\Models\permanence\Permanences;
use App\Models\permanence\Visiteurs;
use App\Models\permanence\Evenements;
use App\Models\Arme;
use App\Models\Optique;
use App\Models\Grade;
use App\Models\Munition;
use App\Models\Personnel;
use Carbon\Carbon;
use Dompdf\Dompdf; // Importez la classe Dompdf
class PermanenceController extends Controller
{
    public function AllPerma(){

        $permanences = Permanences::latest()->simplePaginate(9);
        $moyenpostes = Moyenpostes::all();
        $munitions = Munition::all();
        $armes = Arme::all();
        $evenements = Evenements::all();
        $visiteurs = Visiteurs::all();
        $optiques = Optique::all();
        $personnels = Personnel::all();
        $grades = Grade::all();
        $postegardes = Postegardes::with('armes','munitions','optiques','moyenpostes')->get();


         // return view('permanencier.permanence.liste_permanence',compact('permanences'));
        return view('permanencier.permanence.liste_permanence',compact('postegardes','permanences','evenements','visiteurs','personnels','grades'));
    }



        public function VisitPermanence($permanenceId)
    {
        // Récupérez la permanence en fonction de l'identifiant
       $permanence = Permanences::findOrFail($permanenceId);

       // Récupérez les visiteurs dont la date de visite est comprise entre perm_debut et perm_fin
      $visiteurs = Visiteurs::whereBetween('vis_date', [$permanence->perm_debut, $permanence->perm_fin])
        ->get();

        return view('permanencier.permanence.visite_permanence', compact('visiteurs'));
    }


    

    public function EvenPermanence($permanenceId)
    {
        // Récupérez la permanence en fonction de l'identifiant
       $permanence = Permanences::findOrFail($permanenceId);

       // Récupérez les visiteurs dont la date de visite est comprise entre perm_debut et perm_fin
       $evenements = Evenements::whereBetween('even_date', [$permanence->perm_debut, $permanence->perm_fin])
        ->get();

        return view('permanencier.permanence.evenement_permanence', compact('evenements'));
    }

    public function InvoicePermanence($permanenceId)
    {
        // Récupérez la permanence en fonction de l'identifiant
       $permanence = Permanences::findOrFail($permanenceId);
         // Récupérez également perm_debut et perm_fin
            $permDebut = $permanence->perm_debut;
            $permFin = $permanence->perm_fin;
             // Récupérez chef_poste et poste

             $chefNom = $permanence->chef ? $permanence->chef->nom : '';
             $chefPrenom = $permanence->chef ? $permanence->chef->prenom : '';
             $posteGarde = $permanence->theposte ? $permanence->theposte->poste_nom : '';
             // Récupérez la liste des personnels associés à la permanence
            $equipe = $permanence->personnels;
            $item = Permanences::findOrFail($permanenceId);
            $data = [
                        'permanence' => $permanence,
                        'permDebut' => $permDebut,
                        'permFin' => $permFin,
                        'chefNom' => $chefNom,
                        'chefPrenom' => $chefPrenom,
                        'posteGarde' => $posteGarde,
                        'equipe' => $equipe,
                        'item' => $item,
                    ];
          // Créez une instance de Dompdf
    $dompdf = new Dompdf();

    // Chargez la vue Blade avec les données
    $html = view('permanencier.permanence.invoice', $data)->render();

    // Chargez le contenu HTML dans Dompdf
    $dompdf->loadHtml($html);



    // Rendre le PDF
    $dompdf->render();

    // Téléchargez le PDF
    $dompdf->stream('permanence.pdf');


    exit();
    }



    public function StorePerma(Request $request){

        $personnelIds = $request->input('personnels');

        $data=$request->validate([
            'perm_debut' => 'required',
            'perm_fin' => 'required',
            'poste' => 'required',
            'chef_poste' => 'required',
            // 'personnels' => 'array',
            // 'armes' => 'array',
            // 'quantitearme' => 'array',
            // 'munitions' => 'array',
            // 'quantitemunition' => 'array',
            // 'moyenpostes' => 'array',
            // 'quantitemoyen' => 'array',
        ]);

        $permanence = Permanences::create([
            'perm_debut' => $data['perm_debut'],
            'perm_fin' => $data['perm_fin'],
            'poste' => $data['poste'],
            'chef_poste' => $data['chef_poste'],


        ]);


    $permanence->personnel_pivot()->attach($personnelIds);

    // foreach ($data['armes'] as $index => $armeId) {
    //     $permanence->armes()->attach($armeId, ['quantitearme' => $data['quantitearme'][$index]]);
    // }

    // // Attachez les munitions à la permanence en utilisant la méthode attach
    // foreach ($data['munitions'] as $index => $munitionId) {
    //     $permanence->munitions()->attach($munitionId, ['quantitemunition' => $data['quantitemunition'][$index]]);
    // }

    // // Attachez les munitions à la permanence en utilisant la méthode attach
    // foreach ($data['moyenpostes'] as $index => $moyenposteId) {
    //     $permanence->moyenpostes()->attach($moyenposteId, ['quantitemoyen' => $data['quantitemoyen'][$index]]);
    // }

        $notification = array(
            'message' => 'permanence crée avec succès!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

}//end method

public function DeletePerma($id){

    Permanences::findOrFail($id)->delete();


    $notification = array(
        'message' => 'permanence supprimée avec succès',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}




public function UpdatePerma(Request $request){
    $pid =$request->id;
    // Validation
    $request->validate ([
        'perm_debut' => 'required',
        'perm_fin' => 'required',
        'poste' => 'required',
        'chef_poste' => 'required',
        'arme'=> 'required',
        'quantitearme'=> 'required|integer',
        'munition'=> 'required',
        'quantitemunition'=> 'required|integer',
        'moyen' => 'required',
        'homme' => 'required',



    ]);

    Permanences:: findOrFail($pid)->update([

        'perm_debut' => $request->perm_debut,
        'perm_fin' => $request->perm_fin,
        'poste' => $request->poste,
        'chef_poste' => $request->chef_poste,
        'arme' => $request->arme,
        'quantitearme' => $request->quantitearme,
        'munition' => $request->munition,
        'quantitemunition' => $request->quantitemunition,
        'moyen' => $request->moyen,
        'homme' => $request->homme,

    ]);

    $notification = array(
        'message' => 'Permanence modifié avec succès',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}



// public function search(Request $request)
// {
//     // Récupérez les critères de recherche depuis la requête
//     $permDebut = $request->input('perm_debut');
//     $permFin = $request->input('perm_fin');
//     $posteGarde = $request->input('poste');
//     $chefPoste = $request->input('chef_poste');

//     // Effectuez votre recherche en fonction des critères
//     $results = Permanences::where(function ($query) use ($permDebut, $permFin, $posteGarde, $chefPoste) {
//         if (!empty($permDebut) && !empty($permFin)) {
//             $query->whereBetween('date_debut', [$permDebut, $permFin]);
//         }

//         if (!empty($posteGarde)) {
//             $query->where('poste', 'like', '%' . $posteGarde . '%');
//         }

//         if (!empty($chefPoste)) {
//             $query->where('chef_poste', 'like', '%' . $chefPoste . '%');
//         }
//     })->get();

//     return response()->json(['results' => $results]);

// }


}

