<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Materiel;
use App\Models\User;
use App\Models\StatutReservation;
use App\Models\DureeReservation;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    
    // Afficher la liste des réservations
    public function index()
    {
        
        $reservations = Reservation::paginate(10);
        return view('livewire.reservation.index', compact('reservations'));
        //return view("ges_reservation" ,  compact("reservations"));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $materiels = Materiel::all();
        $users = User::all();
        $statuts = StatutReservation::all();
        $durees = DureeReservation::all();
        return view('livewire.reservation.create', compact('materiels', 'users', 'statuts', 'durees'));
    }
//     public function create()
// {
//     $materiels = Materiel::all();
//     $durees = DureeReservation::all();
//     return view('livewire.reservation.create', compact('materiels', 'durees'));
// }

    // Enregistrer une nouvelle réservation
    // Enregistrer une nouvelle réservation
    public function store1(Request $request)
    {
        $request->validate([
            'materiels' => 'required|array', // Liste des matériels sélectionnés
            'materiels.*' => 'exists:materiels,id', // Vérifie que chaque matériel existe
            'duree_reservation_id' => 'required|exists:duree_reservations,id',
            'date_reservation' => 'required|date',
            'commentaire' => 'nullable|string',
        ]);

        // Créer la réservation
        $reservation = Reservation::create([
            'user_id' => Auth::id(), // Utilisateur connecté
            'statut_reservation_id' => 1, // Statut "En attente"
            'duree_reservation_id' => $request->duree_reservation_id,
            'date_reservation' => $request->date_reservation,
            'commentaire' => $request->commentaire,
        ]);

        // Attacher les matériels à la réservation
        $reservation->materiels()->attach($request->materiels);

        return redirect()->route('reservation.index')->with('success', 'Réservation créée avec succès.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'materiel_id' => 'required|exists:materiels,id',
            'user_id' => 'required|exists:users,id',
            'statut_reservation_id' => 'required|exists:statut_reservations,id',
            'duree_reservation_id' => 'required|exists:duree_reservations,id',
            'date_reservation' => 'required|date',
            'commentaire' => 'nullable|string',
        ]);

        Reservation::create($request->all());

        return redirect()->route('reservation.index')->with('success', 'Réservation ajoutée avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit1($id)
{
    $reservation = Reservation::findOrFail($id);
    $materiels = Materiel::all();
    $durees = DureeReservation::all();
    $statuts = StatutReservation::all();

    // Vérifier si l'utilisateur peut modifier le statut
    $canEditStatut = Auth::user()->isAdmin() || Auth::user()->isResponsableLabo();

    return view('livewire.reservation.edit', compact('reservation', 'materiels', 'durees', 'statuts', 'canEditStatut'));
}



    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $materiels = Materiel::all();
        $users = User::all();
        $statuts = StatutReservation::all();
        $durees = DureeReservation::all();
        return view('livewire.reservation.edit', compact('reservation', 'materiels', 'users', 'statuts', 'durees'));
    }

    // Mettre à jour une réservation

    public function update1(Request $request, $id)
{
    $request->validate([
        'materiels' => 'required|array', // Liste des matériels sélectionnés
        'materiels.*' => 'exists:materiels,id', // Vérifie que chaque matériel existe
        'duree_reservation_id' => 'required|exists:duree_reservations,id',
        'date_reservation' => 'required|date',
        'commentaire' => 'nullable|string',
    ]);

    $reservation = Reservation::findOrFail($id);

    // Mettre à jour les champs de base
    $reservation->update([
        'duree_reservation_id' => $request->duree_reservation_id,
        'date_reservation' => $request->date_reservation,
        'commentaire' => $request->commentaire,
    ]);

    // Mettre à jour les matériels associés
    $reservation->materiels()->sync($request->materiels);

    // Mettre à jour le statut uniquement si l'utilisateur est admin ou responsable de laboratoire
    if (Auth::user()->isAdmin() || Auth::user()->isResponsableLabo()) {
        $reservation->update([
            'statut_reservation_id' => $request->statut_reservation_id,
        ]);
    }

    return redirect()->route('reservation.index')->with('success', 'Réservation mise à jour avec succès.');
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'materiel_id' => 'required|exists:materiels,id',
            'user_id' => 'required|exists:users,id',
            'statut_reservation_id' => 'required|exists:statut_reservations,id',
            'duree_reservation_id' => 'required|exists:duree_reservations,id',
            'date_reservation' => 'required|date',
            'commentaire' => 'nullable|string',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return redirect()->route('reservation.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservation.index')->with('success', 'Réservation supprimée avec succès.');
    }


}
