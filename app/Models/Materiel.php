<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $fillable = ['nom','noSerie', 'imageUrl', 'estMutualisable', 'type_materiel_id', 'proprietaire_materiel_id', 'description', 'date_acquisition', 'estDisponible'];

    // Relation avec TypeMateriel
    public function typeMateriels()
    {
        return $this->belongsTo(TypeMateriel::class,'type_materiel_id');
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'materiel_id');
    }
}
