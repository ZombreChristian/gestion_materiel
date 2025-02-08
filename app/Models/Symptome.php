<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptome extends Model
{
    use HasFactory;

    protected $fillable = [
            'date' ,
            'interne' ,
            'synthese' ,
            'patient' ,
            'medecin' ,
            'annee' ,
            'type_diabete' ,
            'familial' ,
            'medical' ,
            'chirurgical' ,
            'ante_import' ,
            'trait_hypoli' ,
            'bi_thera' ,
            'type_insu' ,
            'schema_insu' ,
            'tri_thera' ,
            'trait_hypogly' ,
            'insulino' ,
            'motif_insu' ,
            'modal_inj' ,
            'insu_agent' ,
            'poids_actu' ,
            'taille' ,
            'tour_taille' ,
            'courbe_pond' ,
            'prise_poids' ,
            'perte_poids' ,
            'date_prise' ,
            'date_perte' ,
            'monotherapie',
    ];

    protected $table = 'symptomes';


    protected $casts = [

        'type_diabete' => 'json',
        'trait_hypoli' => 'json',
        'bi_thera' => 'json',
        'type_insu' => 'json',
        'schema_insu' => 'json',
        'tri_thera' => 'json',
        'trait_hypogly'=> 'json' ,
        'insulino' => 'json',
        'motif_insu' => 'json',
        'modal_inj' => 'json',
        'courbe_pond' => 'json',
        'monotherapie' => 'json',

    ];


   // Dans le modèle Symptome
public function patients()
{
    return $this->hasMany(Patient::class, 'patient', 'id'); // Assurez-vous de spécifier la clé primaire de la table Patient (probablement 'id')
}

}
