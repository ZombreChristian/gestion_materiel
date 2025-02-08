<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permindispo extends Model
{
    use HasFactory;
    protected $fillable = [

        'lieu', 
        'motif',
        'nbreJours',
        'dateDebut',
        'dateFin',
        'addressPermission',

    ];

    public function personnels() {
        return $this->belongsToMany(Personnel::class);
    }


}
