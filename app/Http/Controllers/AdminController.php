<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cotisation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Membre;
use Illuminate\Support\Facades\Crypt;


class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AllMensuelle(Request $request,$membre_id)
{
    $pid =$request->id;
    $membre = Membre::findOrFail($membre_id);
    $cotisations = $membre->cotisations;

    return view('livewire.membres.test', compact('cotisations', 'membre'));
}



    public function dashboard(Request $request)
{
    $resultats = Cotisation::selectRaw('membre_id, SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
        ->groupBy('membre_id')
        ->latest()
        ->paginate(6);

        $membre_id = $request->membre_id; // Supposons que vous récupériez l'ID du membre à partir de la requête
        $sommes = Cotisation::selectRaw('membre_id, Nosemaine, date, SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
            ->where('membre_id', $membre_id) // Filtrer par membre_id
            ->groupBy('membre_id', 'Nosemaine', 'date')
            ->get();

    return view('dashboard', ['resultats' => $resultats,'sommes' =>$sommes]);
    // return view('admin.admin_profile_view',compact('profileData'));

}


// public function Semaine(Request $request)
// {
//     $membre_id = $request->membre_id; // Supposons que vous récupériez l'ID du membre à partir de la requête
//     $sommes = Cotisation::selectRaw('membre_id, Nosemaine, date, SUM(IFNULL(lundi, 0) + IFNULL(mardi, 0) + IFNULL(mercredi, 0) + IFNULL(jeudi, 0) + IFNULL(vendredi, 0) + IFNULL(samedi, 0)) as somme_montants')
//         ->where('membre_id', $membre_id) // Filtrer par membre_id
//         ->groupBy('membre_id', 'Nosemaine', 'date')
//         ->get();

//     return view('livewire.cotisations.semaine', compact('sommes'));
// }


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile_view',compact('profileData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo']= $filename;

        }
        $data->save();
        $notification = array(
            'message' => 'Admin profile Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));
    }




    public function AdminUpdatePassword(Request $request){
        // Validation
        $request->validate ([
            'old_password'=>'required',
            'new_password'=>'required|confirmed',

        ]);
        // Match old password
        if(!Hash::check($request->old_password,auth::user()->password)){
            $notification = array(
                'message' => 'Old password does not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);

        }

                // Match old password
        User::whereId(auth()->user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }

    // admin user All route
    public function AllAdmin(){
        $roles = Role::all();
        // $users = User::all();
        $users = User::with('role')->paginate(2);


        return view('backend.pages.admin.all_admin',compact('users','roles'));



    }

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.pages.admin.add_admin',compact('roles'));
    }


    public function StoreAdmin(Request $request){
        $user = new User();

        // $user-> username = $request->username;
        $user->name = $request->name;
        $user->surname= $request->surname;
        $user->sexe = $request->sexe;
        $user->pieceIdentite = $request->pieceIdentite;
        $user->numeroPieceIdentite = $request->numeroPieceIdentite;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->phone2 = $request->phone2;
        $user->address = $request->address;
        $user-> password = Hash::make($request->password);
        $user->role_id = $request->roles;
        $user-> status = 'active';
        $user->save();

        DB::table('model_has_roles')->insert([
            'role_id' =>$user->role_id  ,
            'model_type'=>'App\Models\User',
            'model_id' =>$user->id
        ]);

        if ($request->roles) {
            $role = Role::where('name', $request->roles)->first();
            if ($role) {
                $user->role_id()->associate($role); // Associe le rôle à l'utilisateur
                $user->save(); // Sauvegarde les modifications
            }
    }


        // if($request->roles){
        //     $user->assignRole($request->roles);
        // }

        $notification = array(
            'message' => 'Utilisateur ajouté avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.roles.all.admin')->with($notification);
    }



        // public function EditAdmin($id){
        //     $user = User::findOrFail($id);
        //     $roles = Role::all();

        //     return view('backend.pages.admin.edit_admin',compact('user','roles'));

        // }


        public function UpdateAdmin(Request $request,$id){
            // $pid =$request->id;
            $user = User::findOrFail($id);

            $user-> name = $request->name;
            $user-> surname= $request->surname;
            $user-> sexe = $request->sexe;
            $user-> pieceIdentite = $request->pieceIdentite;
            $user-> numeroPieceIdentite = $request->numeroPieceIdentite;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->phone2 = $request->phone2;
            $user->address = $request->address;
            $user-> status = $request->status;

             // Vérifier si le mot de passe est modifié dans la requête
    if ($request->filled('password')) {
        // Déchiffrer temporairement le mot de passe pour le formulaire
        $user->password = Crypt::decrypt($request->password);
        // Re-hasher le mot de passe avant de le stocker dans la base de données
        $user->password = Hash::make($user->password);
    }
            $user->role_id = $request->roles;
            $user-> status =$request->status;
            $user->save();

            // $user->roles()->detach();
            // if($request->roles){
            //     $user->assignRole($request->roles);
            // }

            $notification = array(
                'message' => 'Modification effectuée avec succès.',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.roles.all.admin')->with($notification);
        }

        public function DeleteAdmin($id){

            $user = User::findOrFail($id);
            if(!is_null($user)){
                $user->delete();
            }

            $notification = array(
                'message' => 'utilisateur a été supprimé avec succès.',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.roles.all.admin')->with($notification);
        }








}
