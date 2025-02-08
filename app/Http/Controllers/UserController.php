<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\WithPagination;
use Carbon\Carbon;


use App\Models\User;

class UserController extends Controller
{

    use WithPagination;

    public function AllUser(){

        Carbon::setLocale("fr");
        $users = User::latest()->get();

        return view('patients.index',compact('users'));
     }





     public function AddUser(){
        return view('backend.User.add_Users');
     }

     public function StoreUser(Request $request){
        // Validation
        $request->validate ([

            'nom'=>'required',
            'prenom'=>'required',
            'sexe'=>'required',
            'pieceIdentite'=>'required',
            'numeroPieceIdentite'=>'required',
            'telephone1'=>'required',
            'email'=>'required',
            'password'=>'required',


        ]);

        User:: insert([
        'nom'=> $request->nom,
        'prenom'=> $request->prenom,
        'sexe'=> $request->sexe,
        'pieceIdentite'=> $request->pieceIdentite,
        'numeroPieceIdentite'=>$request->numeroPieceIdentite,
        'telephone1'=> $request->telephone1,
        'telephone2'=> $request->telephone2,
        'email'=> $request->email,
        'password'=> $request->password,



        ]);


        $notification = array(
            'message' => 'User a été créé avec succès',
            'alert-type' => 'success'
        );


        return redirect()->route('all.user')->with($notification);


    }

    public function EditUser($id){
        $Users = User::findOrFail($id);
        return view('backend.User.edit_Users',compact('Users'));
     }

     public function UpdateUser(Request $request){

        $pid =$request->id;

        $request->validate ([
            'noSerieMot'=>'required|unique:Users|max:200',
            'nom'=>'required|',


        ]);


        User:: findOrFail($pid)->update([
            'noSerieMot'=> $request->noSerieMot,
            'nom'=> $request->nom,

        ]);

        $notification = array(
            'message' => 'User modifié avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('all.User')->with($notification);


    }

    public function DeleteUser($id){

        User:: findOrFail($id)->delete();


        $notification = array(
            'message' => 'User supprimé avec succès',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.Arme')->with($notification);
        return redirect()->route('all.User')->with($notification);

    }
}
