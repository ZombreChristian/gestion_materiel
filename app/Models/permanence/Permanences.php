<?php

namespace App\Models\permanence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personnel;
use App\Models\Arme;
use App\Models\Grade;
use App\Models\Optique;
use App\Models\Munition;
use App\Models\permanence\Moyenpostes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permanences extends Model
{
    protected $guarded = [];
    use HasFactory;
    
        public function visiteurs()
    {
        return $this->hasMany(Visiteurs::class)
        ->whereBetween('date_vis', [$this->perm_debut, $this->perm_fin]);

    }

    public function evenements(){
        return $this->hasMany(Evenements::class)
        ->whereBetween('even_date', [$this->perm_debut, $this->perm_fin]);
    }

    // public function theposte(){
    //     return $this->belongsTo(Postegardes::class,'poste');
    // }

    public function postegarde()
    {
        return $this->belongsTo(Postegardes::class, 'poste'); // Une permanence appartient à un poste de garde
    }

    // public function postegardes()
    // {
    //     return $this->belongsToMany(Postegardes::class)->withPivot('id'); // Ajoutez d'autres colonnes pivot si nécessaire
    // }

    public function chef(){
        return $this->belongsTo(Personnel::class,'chef_poste');
        
    }

    protected $fillable = ['perm_debut','perm_fin','poste','chef_poste'];

  

    
   

    public function personnel_pivot()
    {
        return $this->belongsToMany(Personnel::class)->withPivot('id');
    }

    public function grade()

    {
        return $this->belongsTo(Grade::class);
    }

    public function personnels()
{
    return $this->belongsToMany(Personnel::class);
}

    
}




