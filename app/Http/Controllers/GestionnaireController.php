<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Arme;





class GestionnaireController extends Controller
{
    // public function GestionnaireDashboard(){
    //     return view('gestionnaire.gestionnaire_dashboard');
    // }


    public function GestionnaireDashboard(){


        $armesCountByNom = DB::table('armes')
        ->select('nom', DB::raw('COUNT(*) as count'))
        ->where('actif', 1)
        ->groupBy('nom')
        ->get();
        $munitions = DB::table('munitions');

        return view('admin.index',compact('armesCountByNom','munitions'));

    }

    public function GestionnaireLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function GestionnaireLogin(){
        return view('gestionnaire.gestionnaire_login');
    }

    public function GestionnaireProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('gestionnaire.gestionnaire_profile_view',compact('profileData'));
    }

    public function GestionnaireProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/gestionnaire_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/gestionnaire_images'),$filename);
            $data['photo']= $filename;

        }
        $data->save();
        $notification = array(
            'message' => 'Gestionnaire profile Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    public function GestionnaireChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('gestionnaire.gestionnaire_change_password',compact('profileData'));
    }




    public function GestionnaireUpdatePassword(Request $request){
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
            'alert-type' => 'success '
        );

        return redirect()->back()->with($notification);


    }

}
