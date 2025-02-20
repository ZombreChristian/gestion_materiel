<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Materiel;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_ges_reserv = Reservation::all();
        //dd($data_ges_reserv);
         // $id_etud = $data_ges_reserv->reference;
          //$data_etud = Personne::find($id_etud);
        //  $nom_etud = $data_etud->nom;
      //    dd($id_etud);
        //session(['nom_etud' => $nom_etud]);
        return view("ges_reservation" ,  compact("data_ges_reserv"));
    }

    public function index2(string $id_materiel)
    {
        $data_materiel = Materiel::find($id_materiel);

        $path_image = $data_materiel->file_name;
        $ref_mat = $data_materiel->reference;
        //dd($ref_mat);
        session(['path_image' => $path_image]);
        session(['ref_mat' => $ref_mat]);
        return view("reservation");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [

            ]);
           //  dd($request);
            try{
                DB::beginTransaction();
                $materiel = Materiel::where("reference", $request->reference)->update(['statut' => "réservé"]);
                //dd($materiel);

                Reservation::create(array_merge($request->all()));
                DB::commit();
                return view('/reservation');
            }catch(\Throwable $th){
              DB::rollBack();
              return view('reservation');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $ref)
    {
      //  dd($id);
        if($ref){
          //  $res = Ges_reservation::destroy($id);
          Materiel::where("reference", $ref)->update(['statut' => "Disponible"]);
          $res = Reservation::where("reference", $ref)->delete();
            return redirect('/ges_reservation');
        }else{
            return redirect('/ges_reservation');
        }

    }



    public function prendre_mat(string $ref)
    {
        $res = Reservation::where('reference', $ref)->update(['statut' => "encour"]);
       // dd($ref);
        if($res)
        {

      //   $success = "Etudiant modifier avec success" ;
         return redirect('/ges_reservation');
        }else{
            return redirect("/ges_reservation");
        }

    }


}
