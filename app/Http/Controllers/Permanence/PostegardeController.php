<?php

namespace App\Http\Controllers\Permanence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permanence\Postegardes;
use App\Models\Arme;
use App\Models\Optique;
use App\Models\Grade;
use App\Models\TypeMunition;
use App\Models\Munition;
use DB;

use App\Models\permanence\Moyenpostes;

class PostegardeController extends Controller
{
    public function AllPoste(){
        $armes = Arme::select('id', 'nom')->distinct()->get();

        $armes = collect($armes)->unique('nom');
        $munitions = Munition::all();
        $optiques = Optique::select('id', 'type')->distinct()->get();
        $optiques = collect($optiques)->unique('type');
        $moyenpostes = Moyenpostes::all();
        $types_munitions = TypeMunition:: all();
        $postegardes = Postegardes::latest()->get();
        return view('permanencier.poste.poste_garde',compact('postegardes','types_munitions','armes','munitions','optiques','moyenpostes'));
    }

    public function StorePoste(Request $request){
        
        $data = $request->validate([
            'poste_nom' => 'required',
            'poste_lieu' => 'required',
            'armes' =>'nullable|array',
            'munitions' => 'nullable|array',
            'optiques' => 'nullable|array',
            'moyenpostes' => 'nullable|array',
            'quantitearme' => 'array',
            'quantiteoptique' => 'array',
            'quantitemunition' => 'array',
            'quantitemoyen' => 'array',
            
        ]);
    
        // Créez un poste de garde
        $poste = new Postegardes([
            'poste_nom' => $data['poste_nom'],
            'poste_lieu' => $data['poste_lieu'],
            
    
        ]);
        // dd($);
    
        $poste->save();
    
    
    
        if (isset($data['armes'])) {
            foreach ($data['armes'] as $index => $armeId) {
                $poste->armes()->attach($armeId, ['quantitearme' => $data['quantitearme'][$index]]);
            }
        }
    
        if (isset($data['optiques'])) {
            foreach ($data['optiques'] as $index => $optiqueId) {
                $poste->optiques()->attach($optiqueId, ['quantiteoptique' => $data['quantiteoptique'][$index]]);
            }
        }
    
        if (isset($data['munitions'])) {
            foreach ($data['munitions'] as $index => $munitionId) {
                $poste->munitions()->attach($munitionId, ['quantitemunition' => $data['quantitemunition'][$index]]);
            }
        }
    
        if (isset($data['moyenpostes'])) {
            foreach ($data['moyenpostes'] as $index => $moyenposteId) {
                $poste->moyenpostes()->attach($moyenposteId, ['quantitemoyen' => $data['quantitemoyen'][$index]]);
            }
        }
    
        $notification = array(
            'message' => 'poste de garde crée avec succès!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
}//end method

    public function DeletePoste($id){

        Postegardes::findOrFail($id)->delete();


        $notification = array(
            'message' => 'poste de garde supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function UpdatePoste(Request $request){
        $pid =$request->id;
        // Validation
        $request->validate ([
            'poste_nom' => 'required',
            'poste_lieu' => 'required',

        ]);

        Postegardes:: findOrFail($pid)->update([
            'poste_nom'=> $request->poste_nom,
            'poste_lieu'=> $request->poste_lieu,
        ]);

        $notification = array(
            'message' => 'Poste de garde modifié avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
