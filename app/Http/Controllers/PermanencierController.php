<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Permanence\Permanences;
use App\Models\Permanence\Visiteurs;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class PermanencierController extends Controller
{
    
    public function PermanencierDashboard()
{
    $totalPermanence = Permanences::count();
    
    $permanencesEnCours = Permanences::where('perm_debut', '<=', now())
        ->where('perm_fin', '>=', now())
        ->count();
    
    $permanencesTerminees = Permanences::where('perm_fin', '<', now())
        ->count();
    
    $permanencesEnAttente = Permanences::where('perm_debut', '>', now())
        ->count();
    
        $visitorData = Visiteurs::select(
            DB::raw('DATE_FORMAT(vis_date, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->get();

          // Formatez les mois en "m-Y" pour le graphique
          $formattedMonths = $visitorData->map(function ($data) {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $data->month);
            return $date->format('m-Y');
        });

    return view('Permanencier.index', compact('totalPermanence', 'permanencesEnCours', 'permanencesTerminees', 'permanencesEnAttente','visitorData','formattedMonths'));
}


    public function PermanencierLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function PermanencierLogin(){
        return view('permanencier.permanencier_login');
    }

    public function PermanencierProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('permanencier.permanencier_profile_view',compact('profileData'));
    }

    public function PermanencierProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/permanencier_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/permanencier_images'),$filename);
            $data['photo']= $filename;

        }
        $data->save();
        $notification = array(
            'message' => 'Permanencier profile Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    public function PermanencierChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('permanencier.permanencier_change_password',compact('profileData'));
    }




    public function PermanencierUpdatePassword(Request $request){
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
