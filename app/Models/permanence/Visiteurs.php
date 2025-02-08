<?php

namespace App\Models\permanence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class Visiteurs extends Model
{
    use HasFactory;
  

    protected $guarded = [];
    public function service()

    {
        return $this->belongsTo(Services::class, 'vis_ser');
    }
   
    public function permanence()
    {
        return $this->belongsTo(Permanences::class);
    }

    public function grade()

    {
        return $this->belongsTo(Grade::class, 'vis_grade');
    }

}
