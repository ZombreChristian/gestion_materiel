<?php

namespace App\Models;
use App\Models\Stage;
use App\Models\Compagnie;
use App\Models\Section;
use App\Models\Groupe;
use App\Models\Permindispo;
use App\Models\Malade;
use App\Models\NonRejoin;
use App\Models\Prison;
use App\Models\Mission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable = [
    'image',
    'matricule',
    'nom',
    'prenom',
    'address',
    'genre',
    'situationMatrimoniale',
    'PersonnePrevenir',
    'NumeroPersonnePrevenir',
    'pseudo',
    'dateNaiss',
    'groupeSang',
    'numeroTelephone',
    'whatsappNumero',
    'numeroinfo',
    'grade_id',
    'status',
    'fonction_id',
    'groupe_id',
    'specialite_id',
    'section_id',
    'compagnie_id',
   ];

public function special()
{
    return $this->belongsTo(Specialite::class,'specialite_id');
}

public function compagnie()
{
    return $this->belongsTo(Compagnie::class, 'compagnie_id');
}

public function section()
{
    return $this->belongsTo(Section::class, 'section_id');
}

public function groupe()
{
    return $this->belongsTo(Groupe::class, 'groupe_id');
}

public function fonction()
{
    return $this->belongsTo(Fonction::class, 'fonction_id');
}

// Dans le modèle Personnel
public function grad()
{
    return $this->belongsTo(Grade::class, 'grade_id');
}

public function dossiers()
{
    return $this->hasMany(Dossier::class);
}
public function missions()
{
    return $this->belongsToMany(Mission::class);
}
public function prisons()
{
    return $this->belongsToMany(Prison::class);
}
public function malades()
{
    return $this->belongsToMany(Malade::class);
}
public function nonRejoins()
{
    return $this->belongsToMany(NonRejoin::class);
}

public function stages()
{
    return $this->belongsToMany(Stage::class);
}
public function permindispos()
{
    return $this->belongsToMany(Permindispo::class);
}
public function permanences()
{
    return $this->belongsToMany(Permanences::class);
}
public function grade()
{
    return $this->belongsTo(Grade::class,'grade_id');
}








public function isEnSituationAtDate($date)
{
    // Récupérez toutes les situations (stages, permindispos, malades, nonRejoins, prisons, missions) de la personne
    $situations = $this->stages->concat(
        $this->permindispos,
        $this->malades,
        $this->nonRejoins,
        $this->prisons,
        $this->missions
    );

    // Parcourez les situations pour vérifier si elles chevauchent la date spécifiée
    foreach ($situations as $situation) {
        if ($date >= $situation->dateDebut && $date <= $situation->dateFin) {
            // La personne est en situation à la date spécifiée
            return true;
        }
    }

    // La personne n'est pas en situation à la date spécifiée
    return false;
}

}
