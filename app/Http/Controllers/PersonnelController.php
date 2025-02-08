<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Personnel;
use App\Models\Grade;
use App\Models\Prison;
use App\Models\Fonction;
use App\Models\Groupe;
use App\Models\Compagnie;
use App\Models\Section;
use App\Models\Dossier;
use App\Models\PermIndispo;
use App\Models\Stage;
use App\Models\NonRejoin;
use App\Models\Malade;
use App\Models\Mission;
use App\Models\Specialite;
use App\Models\Personnel_groupe;
use App\Models\Personnel_fonction;
use Illuminate\Support\Facades\App;
use App\Models\Spa;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonnelImport;


use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


use App\Exports\PersonnelExport;

class PersonnelController extends Controller
{

    public function PersonnelDashboard()

{

// Récupérez le nombre de personnels actifs, inactifs et blessés
    $totalPersonnelsActifs = Personnel::where('status', 'actif')->count();
    $totalPersonnelsInactifs = Personnel::where('status', 'inactif')->count();
    $totalPersonnelsBlesses = Personnel::where('status', 'blessé')->count();
// Récupérez le nombre total de personnel
    $totalPersonnel = Personnel::count();
    $totalMissions = Mission::count();
    $totalDossiers = Dossier::count();
    $totalStages = Stage::count();


    // $missionData = Mission::select(
    //     // DB::raw('DATE_FORMAT(dateDebut, "%Y-%m") as month'),
    //     DB::raw('COUNT(*) as count')
    // )
    // ->groupBy('month')
    // ->orderBy('month', 'ASC')
    // ->get();

    //   // Formatez les mois en "m-Y" pour le graphique
    //   $formattedMonths = $missionData->map(function ($data) {
    //     $date = \Carbon\Carbon::createFromFormat('Y-m', $data->month);
    //     return $date->format('m-Y');
    // });

    return view('personnel.index', compact('totalPersonnel', 'totalMissions', 'totalDossiers', 'totalStages', 'totalPersonnelsActifs', 'totalPersonnelsInactifs', 'totalPersonnelsBlesses'));
}







    public function PersonnelLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function PersonnelLogin(){
        return view('personnel.personnel_login');
    }

    public function PersonnelProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('personnel.personnel_profile_view',compact('profileData'));
    }

    public function PersonnelProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        $data->save();
        $notification = array(
            'message' => 'Personnel profile Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

    public function PersonnelChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('personnel.personnel_change_password',compact('profileData'));
    }

    public function PersonnelUpdatePassword(Request $request){
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
    public function AllPersonnel(){
        $personnels =Personnel::latest()->get();
        $grades= Grade::all();
        $fonctions =Fonction::all();
        $groupes =Groupe::all();
        $compagnies =Compagnie::all();
        $sections =Section::all();
        $specialites =Specialite::all();

        return view('backend.pages.personnel.all_personnel',compact('personnels','grades','fonctions','groupes','compagnies','sections','specialites'));
    }

    public function StorePersonnel(Request $request){
        $data = $request->validate([
          'nom'=>'required',
            'prenom'=>'required',

            // 'groupeSang'=>'required',
            // 'numeroTelephone'=>'required|numeric|max:99999999',
            'grade_id'=>'required|exists:grades,id',
            // 'status'=>'required',
            // 'numeroinfo'=>'required',
            // 'groupe_id'=>'required',
            // 'compagnie_id' => 'required',
            // 'section_id' => 'required',

        ]);


       // Gérer l'upload de l'image
   // Gérer l'upload de l'image
// Gérer l'upload de l'image
if ($request->hasFile('image')) {
    $file = $request->file('image');
    $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
    $destinationPath = public_path('images');
    $file->move($destinationPath, $fileName);
    $data['image'] = 'images/' . $fileName;
} else {
    // Initialiser la clé 'image' à une valeur par défaut (par exemple, 'images/default.jpg')
    $data['image'] = 'images/default.jpg';
}


             // Créez la compagnie en utilisant les données du formulaire
    $personnel=Personnel::create([
            'image' => $data['image'],
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'address' => $request->address,
            'genre' => $request->genre,
            'situationMatrimoniale' => $request->situationMatrimoniale,
            'PersonnePrevenir' => $request->PersonnePrevenir,
            'NumeroPersonnePrevenir' => $request->NumeroPersonnePrevenir,
            'pseudo' => $request->pseudo,
            'dateNaiss' => $request->dateNaiss,
            'groupeSang' => $request->groupeSang,
            'numeroTelephone' => $request->numeroTelephone,
            'whatsappNumero' => $request->whatsappNumero,
            'numeroinfo' => $request->numeroinfo,
            'grade_id' => $request->grade_id,
            'status' => $request->status,
            'fonction_id' => $request->fonction_id,
            'groupe_id' => $request->groupe_id,
            'specialite_id' => $request->specialite_id,
            'compagnie_id' => $request->compagnie_id,
            'section_id' => $request->section_id,
             ]);

       $notification= array(
           'message'=> 'Nouvelle personnel a ete creer avec Success',
           'alert-type'=> 'success'
          );
          return redirect()->route('personnel.all.personnel')->with('success', 'Le personnel a été enregistré avec succès.');

    }
    public function ViewPersonnel($id)
    {
        $personnel = Personnel::with('dossiers')->find($id);

        // Ajoutez la pagination pour les dossiers
        $dossiers = $personnel->dossiers()->paginate(6);
        return view('backend.pages.personnel.view_personnel', compact('personnel', 'id','dossiers'));
    }


   public function UpdatePersonnel(Request $request){
     $pid= $request->id;
     Personnel::findOrFail($pid)->update([
        'image' => $request->file('image'),
        'matricule' => $request->matricule,
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'address' => $request->address,
        'genre' => $request->genre,
        'PersonnePrevenir' => $request->PersonnePrevenir,
        'NumeroPersonnePrevenir' => $request->NumeroPersonnePrevenir,
        'pseudo' => $request->pseudo,
        'dateNaiss' => $request->dateNaiss,
        'groupeSang' => $request->groupeSang,
        'numeroTelephone' => $request->numeroTelephone,
        'whatsappNumero' => $request->whatsappNumero,

        'numeroinfo' => $request->numeroinfo,
        'grade_id' => $request->grade,
        'status' => $request->status,
        'fonction_id' => $request->fonction_id,
        'groupe_id' => $request->groupe_id,
        'specialite_id' => $request->specialite_id,
        'situationMatrimoniale' => $request->situationMatrimoniale,

        'compagnie_id' => $request->compagnie_id,
        'section_id' => $request->section_id,
      ]);

          return redirect()->route('personnel.all.personnel')->with('success', 'Le personnel a été mis à jour avec succès.');

    }
 public function DeletePersonnel($id){
    Personnel::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Le personnel a été supprimé avec succès.');
      }


      public function ImportPersonnel(){
        return view('backend.pages.personnel.import_personnel');

      }
      public function Import(Request $request){
        Excel::import(new PersonnelImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Personnel Importé avec succès',
            'alert-type' => 'success'
        );
    return redirect()->route('personnel.all.personnel')->with($notification);

      }

      public function ExportPersonnel()
{
    return Excel::download(new PersonnelExport, 'personnel.xlsx');
}


//choisir les personnel dans mission
public function getPersonnel(Request $request)
{
    $compagnieId = $request->input('compagnie_id');
    $sectionId = $request->input('section_id');
    $groupeId = $request->input('groupe_id');

    $personnel = Personnel::where('compagnie_id', $compagnieId)
        ->where('section_id', $sectionId)
        ->where('groupe_id', $groupeId)
        ->get();

    return view('personnel.selection', compact('personnel'));
}

}
