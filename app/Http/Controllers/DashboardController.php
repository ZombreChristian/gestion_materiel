<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Equipement;

class DashboardController extends Controller
{

    public function index()
    {

        // Récupérer le nombre total d'utilisateurs
        $totalUtilisateurs = User::count();


        // Récupérer le nombre total d'équipements
        $totalEquipements = Equipement::sum('nombre');

        // Récupérer le nombre total de réservations
        $totalReservations = Equipement::sum('reservations');

        // Récupérer le nombre total d'annulations
        $totalAnnulations = Equipement::sum('annulations');


        // Calcul du taux de réservation
        $tauxReservation = Equipement :: sum('reservations');
        // Récupérer la liste paginée des utilisateurs
        $users = User::paginate(10);


        // Vérifier si les données sont bien récupérées
   // dd($totalUtilisateurs, $totalEquipements, $totalReservations, $totalAnnulations, $tauxReservation, $users);


        return view('dashboard', compact(
            'totalUtilisateurs',
            'totalEquipements',
            'totalReservations',
            'totalAnnulations',
            'tauxReservation',
            'users'
        ));
    }
}
