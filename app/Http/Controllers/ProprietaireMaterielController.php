<?php

namespace App\Http\Controllers;

use App\Models\ProprietaireMateriel;
use Illuminate\Http\Request;

class ProprietaireMaterielController extends Controller
{
     // Afficher la liste des propriétaires
     public function index()
     {
         $proprietaires = ProprietaireMateriel::paginate(10);
         return view('livewire.proprietaireMateriel.index', compact('proprietaires'));
     }
 
     // Afficher le formulaire de création
     public function create()
     {
         return view('livewire.proprietaireMateriel.create');
     }
 
     // Enregistrer un nouveau propriétaire
     public function store(Request $request)
     {
        
         $request->validate([
             'nom' => 'required|string|max:100',
             'contact' => 'required|string|max:20',
             'email' => 'required|email|unique:proprietaire_materiels,email',
         ]);
 
         ProprietaireMateriel::create($request->all());
 
         return redirect()->route('proprietaireMateriel.index')->with('success', 'Propriétaire ajouté avec succès.');
     }
 
     // Afficher le formulaire de modification
     public function edit($id)
     {
         $proprietaire = ProprietaireMateriel::findOrFail($id);
         return view('livewire.proprietaireMateriel.edit', compact('proprietaire'));
     }
 
     // Mettre à jour un propriétaire
     public function update(Request $request, $id)
     {
         $request->validate([
             'nom' => 'required|string|max:100',
             'contact' => 'required|string|max:20',
             'email' => 'required|email|unique:proprietaire_materiels,email,' . $id,
         ]);
 
         $proprietaire = ProprietaireMateriel::findOrFail($id);
         $proprietaire->update($request->all());
 
         return redirect()->route('proprietaireMateriel.index')->with('success', 'Propriétaire mis à jour avec succès.');
     }
 
     // Supprimer un propriétaire
     public function destroy($id)
     {
         $proprietaire = ProprietaireMateriel::findOrFail($id);
         $proprietaire->delete();
 
         return redirect()->route('proprietaireMateriel.index')->with('success', 'Propriétaire supprimé avec succès.');
     }
}
