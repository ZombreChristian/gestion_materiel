<?php

namespace App\Http\Controllers\Permanence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permanence\Services;

class ServiceController extends Controller
{
    
    public function AllService(){
        $services = Services::all();
        return view('permanencier.service.liste_service',compact('services'));
    }

    public function StoreService(Request $request){
        
        $request->validate([
            'sigle_service' => 'required',
            'nom_service' => 'required',
        ]);

        Services::create([
            'sigle_service' => $request->sigle_service,
            'nom_service' => $request->nom_service, 

        ]);

        $notification = array(
            'message' => 'Service crée avec succès!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
}//end method

    public function DeleteService($id){

        Services::findOrFail($id)->delete();


        $notification = array(
            'message' => 'service supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function UpdateService(Request $request){
        $pid =$request->id;
        // Validation
        $request->validate ([
            'sigle_service' => 'required',
            'nom_service' => 'required',

        ]);

        Services:: findOrFail($pid)->update([
            'sigle_service'=> $request->sigle_service,
            'nom_service'=> $request->nom_service,
        ]);

        $notification = array(
            'message' => 'Service modifié avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
