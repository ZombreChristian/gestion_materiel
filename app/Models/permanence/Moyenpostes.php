<?php

namespace App\Models\permanence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\permanence\Permanences;

class Moyenpostes extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function permanences(): BelongsToMany
    {
        return $this->belongsToMany(Permanences::class);
    }
}
