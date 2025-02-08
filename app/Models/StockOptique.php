<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOptique extends Model
{
    use HasFactory;
    public function bons()
{
    return $this->belongsToMany(Bon::class)->withPivot('quantiteoptique');
}
}
