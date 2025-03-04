<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMateriel extends Model
{
    use HasFactory;
    protected $table = "type_materiels";

    protected $fillable = ["nom"];

    public function materiels(){
        return $this->hasMany(Materiel::class,'type_materiel_id');
    }

    public function proprietaires(){
        return $this->hasMany(ProprietaireMateriel::class);
    }
}
