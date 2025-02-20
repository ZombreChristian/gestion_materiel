<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprietaire_materiel extends Model
{
    use HasFactory;
    protected $fillable = ["nom", "estObligatoire", "type_materiels_id"];
    public $timestamps = false;

    public function type(){
        return $this->belongsTo(TypeMateriel::class, "type_materiels_id", "id");
    }

    public function materiels(){
        return $this->belongsToMany(Materiel::class, "materiel_proprietaire", "proprietaire_materiel_id", "materiel_id");
    }
}
