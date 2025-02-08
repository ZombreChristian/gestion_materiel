<?php

namespace App\Http\Controllers\AMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etat;

class EtatController extends Controller
{
    //
  // ----------------------------------------------------------------------


  public function AllEtat(){
    $etats = Etat::latest()->get();
    return view('backend.etat.all_etats',compact('etats'));
 }


 public function StoreEtat(Request $request){
     // Validation
     $request->validate ([
         'nom'=>'required|unique:etats|',

     ]);

     Etat:: insert([
         'nom'=> $request->nom,


     ]);

     $notification = array(
         'message' => 'Etat a été créé avec succès',
         'alert-type' => 'success'
     );


     return redirect()->route('gestionnaire.autres.all.etat')->with($notification);


 }



 public function UpdateEtat(Request $request){

     $pid =$request->id;

     $request->validate ([
        'nom'=>'required|unique:etats|',

     ]);


     Etat:: findOrFail($pid)->update([
         'nom'=> $request->nom,

     ]);

     $notification = array(
         'message' => ' Etat a été modifier avec succès',
         'alert-type' => 'success'
     );


     return redirect()->route('gestionnaire.autres.all.etat')->with($notification);


 }


 public function DeleteEtat($id){

    Etat:: findOrFail($id)->delete();


     $notification = array(
         'message' => 'Etat a été supprimé avec succès',
         'alert-type' => 'success'
     );
     return redirect()->route('gestionnaire.autres.all.etat')->with($notification);

 }

}
