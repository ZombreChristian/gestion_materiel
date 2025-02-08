<?php

namespace App\Http\Controllers\Permanence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permanence\Evenements;
use App\Models\permanence\Postegardes;

class EvenController extends Controller
{
    public function AllEven(){
        $evenements = Evenements::latest()->get();
        $postegardes = Postegardes::all();
        return view('permanencier.evenement.liste_evenement',compact('evenements','postegardes'));
    }

    public function StoreEven(Request $request){
        
        $request->validate([
            'even_date' => 'required',
            'postegarde' => 'required',
            'even_debut' => 'required',
            'even_fin' => 'nullable',
            'even_desc' => 'required',
        ]);
        
        Evenements::create([
            'even_date' => $request->even_date,
            'postegarde' => $request->postegarde,
            'even_debut' => $request->even_debut, 
            'even_fin' => $request->even_fin,
            'even_desc' => $request->even_desc,
      
        ]);

        $notification = array(
            'message' => 'Evènement crée avec succès!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
}//end method

    public function DeleteEven($id){

        Evenements::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Evènement supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function UpdateEven(Request $request){
        $pid =$request->id;
        // Validation
        $request->validate ([
            'even_date' => 'required',
            'postegarde' => 'required',
            'even_debut' => 'required',
            'even_fin' => 'required',
            'even_desc' => 'required',

        ]);

        Evenements:: findOrFail($pid)->update([
            'even_date' => $request->even_date,
            'postegarde' => $request->postegarde,
            'even_debut' => $request->even_debut, 
            'even_fin' => $request->even_fin,
            'even_desc' => $request->even_desc,
      
        ]);

        $notification = array(
            'message' => 'Evènement modifié avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
