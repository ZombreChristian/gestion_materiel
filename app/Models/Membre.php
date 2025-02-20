<?php

namespace App\Models;

use App\Models\Cotisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'dateNaissance',
        'lieuNaissance',
        'nationalite',
        'ville',
        'pays',
        'pieceIdentite',
        'adresse',
        'noPieceIdentite',
        'telephone1',
        'telephone2',
        'email',
    //    'montant',


    ];

    public function cotisations()
    {
        return $this->hasMany(Cotisation::class);
    }
}
