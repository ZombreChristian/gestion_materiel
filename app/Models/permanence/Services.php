<?php

namespace App\Models\permanence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{

    protected $guarded = [];
    use HasFactory;
    
    public function visiteur(){
        return $this->hasMany(Visiteurs::class,'vis_ser');
    }
}
