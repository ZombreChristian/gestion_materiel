<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Symptome;

class SymptomeController extends Controller
{

    public function allSymptome(){
        $users = User::latest()->get();

        return view('patients.symptome',compact('users'));
    }

    public function StoreSymptome(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            // 'date' => 'required|string',
            // 'interne' => 'required|string',
            // 'synthese' => 'required|string',
            // 'patient' => 'required|string',
            // 'medecin' => 'required|string',
            // 'annee' => 'required|string',
            // 'type_diabete' => 'nullable|string',
            // 'familial' => 'nullable|string',
            // 'medical' => 'nullable|string',
            // 'chirurgical' => 'nullable|string',
            // 'ante_import' => 'nullable|string',
            // 'trait_hypoli' => 'nullable|string',
            // 'bi_thera' => 'nullable|string',
            // 'type_insu' => 'nullable|string',
            // 'schema_insu' => 'nullable|string',
            // 'tri_thera' => 'nullable|string',
            // 'trait_hypogly' => 'nullable|string',
            // 'insulino' => 'nullable|string',
            // 'motif_insu' => 'nullable|string',
            // 'modal_inj' => 'nullable|string',
            // 'insu_agent' => 'nullable|string',
            // 'poids_actu' => 'nullable|string',
            // 'taille' => 'nullable|string',
            // 'tour_taille' => 'nullable|string',
            // 'courbe_pond' => 'nullable|string',
            // 'prise_poids' => 'nullable|string',
            // 'perte_poids' => 'nullable|string',
            // 'date_prise' => 'nullable|string',
            // 'date_perte' => 'nullable|string',

        ]);

        // Récupérer les données du formulaire
        $donnees = $request->all();

        // Convertir les cases à cocher en JSON
        $type_diabete = [
            'checkboxPrimary1' => $request->has('checkboxPrimary1'),
            'checkboxPrimary2' => $request->has('checkboxPrimary2'),
            'checkboxPrimary3' => $request->has('checkboxPrimary3'),
            'checkboxPrimary4' => $request->has('checkboxPrimary4'),
            'checkboxPrimary5' => $request->has('checkboxPrimary5'),
            'checkboxPrimary6' => $request->has('checkboxPrimary6'),
        ];

        $trait_hypoli = [
            'checkboxPrimary1' => $request->has('checkboxPrimary7'),
            'checkboxPrimary2' => $request->has('checkboxPrimary8'),
            'checkboxPrimary3' => $request->has('checkboxPrimary9'),
            'checkboxPrimary4' => $request->has('checkboxPrimary10'),

        ];
        $bi_thera = [
            'checkboxPrimary11' => $request->has('checkboxPrimary11'),
            'checkboxPrimary12' => $request->has('checkboxPrimary12'),
            'checkboxPrimary13' => $request->has('checkboxPrimary13'),
            'checkboxPrimary14' => $request->has('checkboxPrimary14'),
            'checkboxPrimary15' => $request->has('checkboxPrimary15'),
            'checkboxPrimary16' => $request->has('checkboxPrimary16'),
            'checkboxPrimary17' => $request->has('checkboxPrimary17'),

        ];
        $type_insu = [
            'checkboxPrimary18' => $request->has('checkboxPrimary18'),
            'checkboxPrimary19' => $request->has('checkboxPrimary19'),
            'checkboxPrimary20' => $request->has('checkboxPrimary20'),

        ];
        $schema_insu = [
            'checkboxPrimary34' => $request->has('checkboxPrimary34'),
            'checkboxPrimary35' => $request->has('checkboxPrimary35'),
            'checkboxPrimary47' => $request->has('checkboxPrimary47'),
            'checkboxPrimary36' => $request->has('checkboxPrimary36'),
            'checkboxPrimary37' => $request->has('checkboxPrimary37'),

        ];
        $tri_thera = [
            'checkboxPrimary31' => $request->has('checkboxPrimary31'),
            'checkboxPrimary32' => $request->has('checkboxPrimary32'),
            'checkboxPrimary33' => $request->has('checkboxPrimary33'),

        ];
        $trait_hypogly = [
            'checkboxPrimary25' => $request->has('checkboxPrimary25'),
            'checkboxPrimary26' => $request->has('checkboxPrimary26'),
            'checkboxPrimary27' => $request->has('checkboxPrimary27'),

        ];
        $insulino = [
            'checkboxPrimary28' => $request->has('checkboxPrimary28'),
            'checkboxPrimary46' => $request->has('checkboxPrimary46'),
            'checkboxPrimary29' => $request->has('checkboxPrimary29'),
            'checkboxPrimary30' => $request->has('checkboxPrimary30'),

        ];
        $motif_insu = [
            'checkboxPrimary38' => $request->has('checkboxPrimary38'),
            'checkboxPrimary39' => $request->has('checkboxPrimary39'),
            'checkboxPrimary40' => $request->has('checkboxPrimary40'),
            'checkboxPrimary41' => $request->has('checkboxPrimary41'),
            'checkboxPrimary42' => $request->has('checkboxPrimary42'),
        ];
        $modal_inj = [
            'checkboxPrimary43' => $request->has('checkboxPrimary43'),
            'checkboxPrimary44' => $request->has('checkboxPrimary44'),
            'checkboxPrimary45' => $request->has('checkboxPrimary45'),

        ];

        $monotherapie = [
            'checkboxPrimary21' => $request->has('checkboxPrimary21'),
            'checkboxPrimary22' => $request->has('checkboxPrimary22'),
            'checkboxPrimary23' => $request->has('checkboxPrimary23'),
            'checkboxPrimary24' => $request->has('checkboxPrimary24'),


        ];

        // Enregistrez les données dans la base de données
        Symptome::create([

            'date' => $donnees['date'],
            'interne' => $donnees['interne'],
            'synthese' => $donnees['synthese'],
            'patient' => $donnees['patient'],
            'medecin' => $donnees['medecin'],
            'annee' => $donnees['annee'],
            'synthese' => $donnees['synthese'],
            'ante_import' => $donnees['ante_import'],

            'familial'=> $request->familial,
            'chirurgical'=> $request->chirurgical,
            'med ical'=> $request->medical,

            'insu_agent'=> $request->insu_agent,
            'poids_actu'=> $request->poids_actu,
            'taille'=> $request->taille,
            'tour_taille'=> $request->tour_taille,
            'prise_poids'=> $request->prise_poids,
            'perte_poids'=> $request->perte_poids,
            'date_prise'=> $request->date_prise,
            'date_perte'=> $request->date_perte,
            // 'medical'=> $request->medical,

            // 'familial' => $donnees['familial'],
            // 'medical' => $donnees['medical'],
            // 'chirurgical' => $donnees['chirurgical'],
            // 'insu_agent' => $donnees['insu_agent'],
            // 'poids_actu' => $donnees['poids_actu'],
            // 'taille' => $donnees['taille'],
            // 'tour_taille' => $donnees['tour_taille'],
            // 'prise_poids' => $donnees['prise_poids'],
            // 'perte_poids' => $donnees['perte_poids'],
            // 'date_prise' => $donnees['date_prise'],
            // 'date_perte' => $donnees['date_perte'],


            'type_diabete' => json_encode($type_diabete),
            'trait_hypoli' => json_encode($trait_hypoli),
            'bi_thera' => json_encode($bi_thera),
            'type_insu' => json_encode($type_insu),
            'schema_insu' => json_encode($schema_insu),
            'tri_thera' => json_encode($tri_thera),
            'trait_hypogly' => json_encode($trait_hypogly),
            'insulino' => json_encode($insulino),
            'motif_insu' => json_encode($motif_insu),
            'modal_inj' => json_encode($modal_inj),
            // 'monotherapie' => json_encode($monotherapie),
        ]);

        // Redirigez l'utilisateur après l'enregistrement
        return redirect()->route('all.symptome')->with('success', 'Symptomes enregistrés avec succès!');
    }
}
