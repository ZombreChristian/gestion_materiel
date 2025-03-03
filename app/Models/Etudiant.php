<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
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


    ];
}
