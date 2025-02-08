<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;

    protected $fillable = [

        'date',
        'membre_id',
        'lundi',
        'mardi',
        'mercredi',
        'jeudi',
        'vendredi',
        'samedi',
        'Nosemaine',
        'montant',

    ];

     // Définir les champs qui peuvent contenir des valeurs null
     protected $casts = [
        'lundi' => 'integer',
        'mardi' => 'integer',
        'mercredi' => 'integer',
        'jeudi' => 'integer',
        'vendredi' => 'integer',
        'samedi' => 'integer',
    ];

    public function membres()
    {
        return $this->belongsTo(Membre::class, 'membre_id');
    }
}
