<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomSpecialite',  
        // Ajoutez d'autres colonnes ici
    ];

    public function personnels()
    {
        return $this->hasMany(Personnel::class);
    }
    
}
