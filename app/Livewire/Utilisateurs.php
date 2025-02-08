<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Validation\Rule;





use Livewire\Component;

class Utilisateurs extends Component
{

    public $delete_user_id;
    public $student_delete_id;
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $isBtnAddClicked = false;
    public $newUser = [];

    public function render()
    {
        Carbon::setLocale("fr");

        return view('livewire.utilisateurs.index', [
            "users" => User::latest()->paginate(5)
        ])
        ->extends('layouts.master')
        ->section("contenu");
    }

    public function goToAddUser(){
        $this->isBtnAddClicked = true;
    }

    public function goToListUser(){
        $this->isBtnAddClicked = false;
    }



    public function addUser(){

        $validationAttributes = $this->validate();
        $validationAttributes["newUser"]["password"] = "password";

       // Ajouter un nouvel user
       User::create($validationAttributes["newUser"]);

       $this->newUser = [];
    $notification = array(
        'message' => "L'utilisateur a été créé avec succès",
        'alert-type' => 'success'
    );

    return redirect()->route('admin.habilitations.users.index')->with($notification);

    }



    protected $rules=


            // 'required|email|unique:users,email Rule::unique("users", "email")->ignore($this->editUser['id'])
            [
            'newUser.nom' => 'required',
            'newUser.prenom' => 'required',
            'newUser.email' => 'required|email|unique:users,email',
            'newUser.telephone1' => 'required|numeric|unique:users,telephone1',
            'newUser.pieceIdentite' => 'required',
            'newUser.sexe' => 'required',
            'newUser.numeroPieceIdentite' => 'required|unique:users,numeroPieceIdentite',
            ];

            protected $messages = [
                'newUser.nom.required' => 'Le nom est obligatoire.',
                'email.email' => 'The Email Address format is not valid.',
            ];

            protected $validationAttributes = [
                'newUser.telephone1' => 'numero de telephone 1'
            ];


            // public function confirmDelete($name, $id){
            //     $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            //         "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
            //         "title" => "Êtes-vous sûr de continuer?",
            //         "type" => "warning",
            //         "data" => [
            //             "user_id" => $id
            //         ]
            //     ]]);
            // }

//             public function confirmDelete($name, $id)
// {
//     $this->dispatchBrowserEvent("showConfirmMessage", [
//         "message" => [
//             "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
//             "title" => "Êtes-vous sûr de continuer?",
//             "type" => "warning",
//             "data" => [
//                 "user_id" => $id
//             ]
//         ]
//     ]);
// }

// public function confirmDelete($id)
// {
//     $this->$delete_user_id = $id;
//     return true

// }

//Delete Confirmation
public function confirmDelete($id)
{
    $this->delete_user_id = $id; //student id

}

// public function confirmDelete($name, $id){
//     $this->dispatch("showConfirmMessage", ["message"=> [
//         "text" => "Vous êtes sur le point de supprimer $name de la liste des utilisateurs. Voulez-vous continuer?",
//         "title" => "Êtes-vous sûr de continuer?",
//         "type" => "warning",
//         "data" => [
//             "user_id" => $id
//         ]
//     ]]);
// }




// public function deleteUser(){
//     $user= User::where('id',$this->delete_user_id)->first();
//     $user->delete();

//     // User:: findOrFail($id)->delete();

//      $notification = array(
//          'message' => 'user a été supprimé avec succès',
//          'alert-type' => 'success'
//      );
//      return redirect()->route('admin.habilitations.users.index')->with($notification);

//  }

 public function DeleteUser($id){

    User::findOrFail($id)->delete();
    // User::destroy($id);


     $notification = array(
         'message' => 'user a été supprimé avec succès',
         'alert-type' => 'success'
     );
     return redirect()->route('admin.habilitations.users.index')->with($notification);

 }






}


            // public function confirmDelete($id){

            //     User:: findOrFail($id)->delete();


            //     $notification = array(
            //         'message' => 'user supprimé avec succès',
            //         'alert-type' => 'success'
            //     );


            //     // return redirect()->route('all.Arme')->with($notification);
            //     return redirect()->route('admin.habilitations.users.index')->with($notification);

            // }



