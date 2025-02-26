<?php

namespace App\Http\Controllers;


use App\Models\Materiel;
use App\Models\TypeMateriel;
use App\Models\ProprietaireMateriel;
use App\Models\dureeReservation;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
     // Afficher la liste des matériels
     public function index()
     {
         $durees = DureeReservation::all(); // Assuming DureeReservation is your model
         $materiels = Materiel::paginate(10);
         return view('livewire.materiel.index', compact('materiels', 'durees'));
     }
 
     // Afficher le formulaire de création
     public function create()
     {
         $types = TypeMateriel::all();
         $proprietaires = ProprietaireMateriel::all();
         return view('livewire.materiel.create', compact('types', 'proprietaires'));
     }
 
     // Enregistrer un nouveau matériel
     public function store(Request $request)
     {
         $validated = $request->validate([
             'nom' => 'required|string|max:100',
             'imageUrl' => 'nullable|url',
             'estMutualisable' => 'boolean',
             'type_materiel_id' => 'required|exists:type_materiels,id',
             'proprietaire_materiel_id' => 'required|exists:proprietaire_materiels,id',
             'description' => 'nullable|string',
             'date_acquisition' => 'required|date',
         ]);
     
         $materiel = new Materiel();
         $materiel->nom = $validated['nom'];
         $materiel->imageUrl = $validated['imageUrl'] ?? null; // Éviter les erreurs si null
         $materiel->estMutualisable = $validated['estMutualisable'] ?? false; 
         $materiel->type_materiel_id = $validated['type_materiel_id'];
         $materiel->proprietaire_materiel_id = $validated['proprietaire_materiel_id'];
         $materiel->description = $validated['description'] ?? '';
         $materiel->date_acquisition = $validated['date_acquisition'];
     
         // Gestion de l'image
         if ($request->hasFile('image')) {
             $imagePath = $request->file('image')->store('materiels_images', 'public');
             $materiel->imageUrl = $imagePath; // Correction ici : enregistrer l'image uploadée
         }
     
         $materiel->save();
     
         return redirect()->route('materiel.index')->with('success', 'Matériel ajouté avec succès !');
     }
     
 
     // Afficher le formulaire de modification
     public function edit($id)
     {
         $materiel = Materiel::findOrFail($id);
         $types = TypeMateriel::all();
         $proprietaires = ProprietaireMateriel::all();
         return view('livewire.materiel.edit', compact('materiel', 'types', 'proprietaires'));
     }
 
     // Mettre à jour un matériel
     public function update(Request $request, $id)
     {
         $request->validate([
            'nom' => 'required|string|max:100',
            'imageUrl' => 'nullable|url',
            'estMutualisable' => 'boolean',
            'type_materiel_id' => 'required|exists:type_materiels,id',
            'proprietaire_materiel_id' => 'required|exists:proprietaire_materiels,id',
            'description' => 'nullable|string',
            'date_acquisition' => 'required|date',
         ]);
 
         $materiel = Materiel::findOrFail($id);
         $materiel->update($request->all());
 
         return redirect()->route('materiel.index')->with('success', 'Matériel mis à jour avec succès.');
     }
 
     // Supprimer un matériel
     public function destroy($id)
     {
         $materiel = Materiel::findOrFail($id);
         $materiel->delete();
 
         return redirect()->route('materiel.index')->with('success', 'Matériel supprimé avec succès.');
     }
}
