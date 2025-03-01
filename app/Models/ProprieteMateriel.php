<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProprieteMateriel extends Model
{
    use HasFactory;
    protected $fillable = ['materiel_id', 'propriete', 'valeur'];

    // Relation avec Materiel
    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }
}
