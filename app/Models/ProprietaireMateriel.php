<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProprietaireMateriel extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'contact', 'email'];

    // Relation avec Materiel
    public function materiels()
    {
        return $this->hasMany(Materiel::class);
    }
}
