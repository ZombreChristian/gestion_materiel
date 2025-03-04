<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TypeMateriel;
use App\Models\Membre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class TypeMaterielController extends Controller
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function AllType(){

        Carbon::setLocale("fr");
        $types = TypeMateriel::latest()->paginate(25);



        return view('livewire.typeMateriel.index', compact('types'));

     }

   
    // public function AddRole(){
    //     return view('backend.pages.roles.add_roles');
    //  }

     public function StoreType(Request $request){

         // Validation
         $request->validate ([
            'nom'=>'required',

        ]);
        $types = TypeMateriel::create([
            'nom' => $request->nom,
        ]);

        $notification = array(
            'message' => 'Type Create Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('equipements.all.type')->with($notification);

    }

    // public function EditType($id){
    //     $roles = TypeMateriel::findOrFail($id);
    //     return view('backend.pages.roles.edit_roles',compact('roles'));
    //  }

     public function UpdateType(Request $request){

        $pid =$request->id;

         // Validation
         $request->validate ([
            'nom'=>'required|unique:type_Materiels',

        ]);

        TypeMateriel:: findOrFail($pid)->update([
            'nom'=> $request->nom,


        ]);

        $notification = array(
            'message' => 'Type Update Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('equipements.all.type')->with($notification);


    }


    public function DeleteType($id){

        TypeMateriel::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Type delete Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('equipements.all.type')->with($notification);

    }
}
