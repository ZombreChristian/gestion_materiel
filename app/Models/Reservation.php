<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

    protected $fillable = [
        'id_etudiant',
        'date_reser',
        'reference',
        'commentaire',
        'periode'
       ];
    use HasFactory;
}
