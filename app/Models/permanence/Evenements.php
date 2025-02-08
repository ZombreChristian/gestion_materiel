<?php

namespace App\Models\permanence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\permanence\Postegardes;

class Evenements extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    public function permanence()
    {
        return $this->belongsTo(Permanences::class);
    }

    public function poste()

    {
        return $this->belongsTo(Postegardes::class, 'postegarde');
    }
}

