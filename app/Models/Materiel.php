<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'imageUrl', 'estMutualisable', 'type_materiel_id', 'proprietaire_materiel_id', 'description', 'date_acquisition'];

    // Relation avec TypeMateriel
    public function typeMateriel()
    {
        return $this->belongsTo(TypeMateriel::class);
    }

    // Relation avec ProprietaireMateriel
    public function proprietaireMateriel()
    {
        return $this->belongsTo(ProprietaireMateriel::class);
    }

    // Relation avec ProprieteMateriel
    public function proprietes()
    {
        return $this->hasMany(ProprieteMateriel::class);
    }

    // Relation avec Reservation
    // public function reservations()
    // {
    //     return $this->hasMany(Reservation::class);
    // }
    // Relation avec Reservation (many-to-many)
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'materiel_reservation');
    }
}
