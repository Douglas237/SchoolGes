<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programmesemaine extends Model
{
    use HasFactory;

    public function cahiers()
    {
        return $this->belongsToMany(CahierTexte::class,'programmesemaines_cahiertextes','prgSemaine_id','cahiertexte_id')
        ->withTimestamps();
    }


    public function matieres()
    {
        return $this->belongsToMany(Matiere::class,'programmesemaines_matieres','prgSemaine_id','matiere_id')
        ->withTimestamps();
    }
}
