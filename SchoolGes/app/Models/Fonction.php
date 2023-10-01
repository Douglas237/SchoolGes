<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;

    public function responsableatelier()
    {
        return $this->belongsToMany(ResponsableAtelier::class, 'responsable_ateliers', 'fonction_id', 'atelier_id','enseignant_id')->withTimestamps();
    }
}
