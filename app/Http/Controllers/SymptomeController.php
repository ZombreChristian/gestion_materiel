<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Symptome;

class SymptomeController extends Controller
{

    public function AllSymptome(){
        $patients = Patient::latest()->get();
        $users = User::latest()->get();

        $symptomes = Symptome::latest()->get();

        return view('patients.symptome',compact('patients','users','symptomes'));
    }






    public function StoreSymptome(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            // 'date' => 'required|string',
            // 'interne' => 'required|string',
            // 'synthese' => 'required|string',


        ]);



        // Enregistrez les données dans la base de données
        Symptome::create([


            'date'=> $request->date,
            'interne'=> $request->interne,
            'synthese'=> $request->synthese,
            'patient'=> $request->patient,
            'medecin'=> $request->medecin,
            'annee'=> $request->annee,
            'ante_import'=> $request->ante_import,
            'familial'=> $request->familial,
            'chirurgical'=> $request->chirurgical,
            'medical'=> $request->medical,

            'insu_agent'=> $request->insu_agent,
            'poids_actu'=> $request->poids_actu,
            'taille'=> $request->taille,
            'tour_taille'=> $request->tour_taille,
            'prise_poids'=> $request->prise_poids,
            'perte_poids'=> $request->perte_poids,
            'date_prise'=> $request->date_prise,
            'date_perte'=> $request->date_perte,

            // 'type_diabete' => implode(',', $request->type_diabete),
            // 'trait_hypoli' => implode(',', $request->trait_hypoli),

            // 'bi_thera' => implode(',', $request->bi_thera),

            // 'type_insu' => implode(',', $request->type_insu),
            // 'schema_insu' => implode(',', $request->schema_insu),
            // 'tri_thera' => implode(',', $request->tri_thera),


            // 'trait_hypogly' => implode(',', $request->trait_hypogly),

            // 'insulino' => implode(',', $request->insulino),
            // 'motif_insu' => implode(',', $request->motif_insu),
            // 'modal_inj' => implode(',', $request->modal_inj),

            'tri_thera' => is_array($request->tri_thera) ? implode(',', $request->tri_thera) : null,
            'modal_inj' => is_array($request->modal_inj) ? implode(',', $request->modal_inj) : null,
            'motif_insu' => is_array($request->motif_insu) ? implode(',', $request->motif_insu) : null,
            'insulino' => is_array($request->insulino) ? implode(',', $request->insulino) : null,
            'trait_hypogly' => is_array($request->trait_hypogly) ? implode(',', $request->trait_hypogly) : null,
            'schema_insu' => is_array($request->schema_insu) ? implode(',', $request->schema_insu) : null,
            'type_insu' => is_array($request->type_insu) ? implode(',', $request->type_insu) : null,
            'bi_thera' => is_array($request->bi_thera) ? implode(',', $request->bi_thera) : null,
            'trait_hypoli' => is_array($request->trait_hypoli) ? implode(',', $request->trait_hypoli) : null,
            'type_diabete' => is_array($request->type_diabete) ? implode(',', $request->type_diabete) : null,

            'monotherapie' => is_array($request->monotherapie) ? implode(',', $request->monotherapie) : null,







        ]);


        // Redirigez l'utilisateur après l'enregistrement
        return redirect()->route('admin.symptomes.all.symptome')->with('success', 'Consultation enregistrée avec succès!');
    }
}
