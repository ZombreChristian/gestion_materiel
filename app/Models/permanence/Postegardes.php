<?php

namespace App\Models\permanence;
use App\Models\Arme;
use App\Models\Grade;
use App\Models\Munition;
use App\Models\Optique;
use App\Models\permanence\Moyenpostes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postegardes extends Model
{
    use HasFactory;
    protected $fillable = [
        'poste_nom', // Ajoutez les autres attributs ici
        'poste_lieu',
];

    public function armes()
    {
        return $this->belongsToMany(Arme::class)->withPivot('quantitearme');
    }


    public function munitions()
    {
        return $this->belongsToMany(Munition::class)->withPivot('quantitemunition');
    }


    public function optiques()
    {
        return $this->belongsToMany(Optique::class)->withPivot('quantiteoptique');
    }

    public function moyenpostes()
    {
        return $this->belongsToMany(Moyenpostes::class)
        ->withPivot('quantitemoyen'); // Ajoutez la colonne pivot 'quantitemoyen'
    }

 
    public function permanences()
    {
        return $this->hasMany(Permanences::class, 'poste'); // Un poste de garde peut avoir plusieurs permanences
    }
    
}
