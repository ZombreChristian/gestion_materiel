<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    use HasFactory;

    protected $fillable = [
        'materiel_id',
        'statut_reservation_id',
        'duree_reservation_id',
        'user_id', // Ajout de user_id
        'date_reservation',
        'commentaire',
    ];

    // Relation avec Materiel
    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }

     // Relation avec Materiel (many-to-many)
     public function materiels()
     {
         return $this->belongsToMany(Materiel::class, 'materiel_reservation');
     }
    // Relation avec StatutReservation
    public function statutReservation()
    {
        return $this->belongsTo(StatutReservation::class);
    }

    // Relation avec DureeReservation
    public function dureeReservation()
    {
        return $this->belongsTo(DureeReservation::class);
    }

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
