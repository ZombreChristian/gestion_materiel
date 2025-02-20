<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    public $fillable = [
        "nom", "noSerie", "type_materiels_id", "imageUrl"
    ];


    public function type(){
        return $this->belongsTo(TypeMateriel::class, "type_materiels_id", "id");
    }

    // public function tarifications(){
    //     return $this->hasMany(Tarification::class);
    // }

    public function reservations(){
        return $this->belongsToMany(Reservation::class,"materiel_reservation", "materiel_id", "reservation_id");
    }

    public function proprietaires(){
        return $this->belongsToMany(ProprietaireMateriel::class,"materiel_proprietaire", "materiel_id", "proprietaire_materiel_id");
    }

    public function materiels_proprietaires(){
        return $this->hasMany(MaterielProprietaire::class);
    }
}
