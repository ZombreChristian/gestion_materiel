<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMunition extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_munition',

        'quantite',
    ];

    // app/Models/Munition.php
public function stockMunition()
{
    return $this->hasOne(StockMunition::class, 'nom_munition', 'type');
}

}
