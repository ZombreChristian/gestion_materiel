<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prison extends Model
{
    use HasFactory;
    protected $fillable = [
        'motif',
        'dateDebut',
        'dateFin',




    ];


    public function personnels() {
        return $this->belongsToMany(Personnel::class);
    }
}
