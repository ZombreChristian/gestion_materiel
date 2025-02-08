<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = [
        // Ajoutez les autres attributs ici

        'dateDebut',
        'dateFin',
        'pays',
        'nomStage',
        'descriptionStage',
    ];

    

    public function personnels() {
        return $this->belongsToMany(Personnel::class);
    }
}
