<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $fillable = [
        'id_user', 'id_equipment', 'reference', 'periode', 'date_reser', 'heure_debut', 'heure_fin', 'statut', 'commentaire'
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // Spécifier la clé étrangère id_user
    }

    // Relation avec l'équipement
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'id_equipment'); // Spécifier la clé étrangère id_equipment
    }
}
