<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel_proprietaire extends Model
{
    use HasFactory;
    
    public $table = "materiel_proprietaire";
    public $fillable = [
        "materiel_id", "proprietaire_materiel_id", "valeur"
    ];

    public function proprietaire(){
        return $this->hasOne(ProprietaireMateriel::class,'id', 'proprietaire_materiel_id'); 
    }
}
