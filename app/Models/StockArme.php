<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockArme extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_arme',

        'quantite',
    ];


    public function bons()
{
    return $this->belongsToMany(Bon::class)->withPivot('quantitearme');
}


}
