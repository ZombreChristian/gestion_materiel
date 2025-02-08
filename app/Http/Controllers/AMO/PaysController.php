<?php

namespace App\Http\Controllers\AMO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pays;


class PaysController extends Controller
{
    //
  // ----------------------------------------------------------------------


  public function AllPays(){
    $pays = Pays::latest()->get();
    return view('backend.pays.all_pays',compact('pays'));
 }

//  public function AddTypeArme(){
//      return view('backend.arme.add_armes');
//   }

 public function StorePays(Request $request){
     // Validation
     $request->validate ([
         'nom'=>'required|unique:pays',

     ]);

     Pays:: insert([
         'nom'=> $request->nom,


     ]);

     $notification = array(
         'message' => 'Pays a été créé avec succès',
         'alert-type' => 'success'
     );


     return redirect()->route('gestionnaire.autres.all.pays')->with($notification);


 }

//  public function EditTypeArme($id){
//      $armes = typeArme::findOrFail($id);
//      return view('backend.arme.edit_armes',compact('armes'));
//   }



 public function UpdatePays(Request $request){

     $pid =$request->id;

     $request->validate ([
        'nom'=>'required|unique:pays|',

     ]);


     Pays:: findOrFail($pid)->update([
         'nom'=> $request->nom,

     ]);

     $notification = array(
         'message' => ' Pays a été modifier avec succès',
         'alert-type' => 'success'
     );


     return redirect()->route('gestionnaire.autres.all.pays')->with($notification);


 }


 public function DeletePays($id){

    Pays:: findOrFail($id)->delete();


     $notification = array(
         'message' => 'Pays a été supprimé avec succès',
         'alert-type' => 'success'
     );
     return redirect()->route('gestionnaire.autres.all.pays')->with($notification);

 }

}
