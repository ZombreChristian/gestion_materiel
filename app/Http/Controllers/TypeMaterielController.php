<?php

namespace App\Http\Controllers;


use App\Models\TypeMateriel; // Importez le modèle TypeMateriel
use Illuminate\Http\Request;

class TypeMaterielController extends Controller
{
    // Afficher la liste des types de matériel
    public function index()
    {
         // Paginer les types de matériel (10 éléments par page)
         $types = TypeMateriel::paginate(10);
        //$types = TypeMateriel::all();
        return view('livewire.typeMateriel.index', compact('types'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('livewire.typeMateriel.create');
    }

    // Enregistrer un nouveau type de matériel
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        TypeMateriel::create($request->all());

        return redirect()->route('typeMateriel.index')->with('success', 'Type de matériel créé avec succès.');
    }

    // Afficher les détails d'un type de matériel
    public function show(TypeMateriel $typeMateriel)
    {
        return view('livewire.typeMateriel.show', compact('typeMateriel'));
    }

    // Afficher le formulaire d'édition
    public function edit( $id)
    {
        $typeMateriel = TypeMateriel::findOrFail($id);
        return view('livewire.typeMateriel.edit', compact('typeMateriel'));
    }

    // Mettre à jour un type de matériel
    public function update(Request $request, $id)
    {
        $typeMateriel = TypeMateriel::findOrFail($id);
        
        $request->validate([
            'nom' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);
    
        $typeMateriel->update($request->all());
    
        return redirect()->route('typeMateriel.index')->with('success', 'Type de matériel mis à jour avec succès.');
    }
    

    // Supprimer un type de matériel
    public function destroy(TypeMateriel $typeMateriel)
    {
        $typeMateriel->delete();
        return redirect()->route('typeMateriel.index')->with('success', 'Type de matériel supprimé avec succès.');
    }
}
