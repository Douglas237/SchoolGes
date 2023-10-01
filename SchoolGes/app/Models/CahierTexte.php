<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CahierTexte extends Model
{
    use HasFactory;
    protected $fillable = ['periode_consommee','periode_restante','status','avance','retard','description','salleClasse_id','matiere_id'];

    public function salleclasse(){
        return $this->belongsTo(SalleClasse::class, 'salleClasse_id','matiere_id', 'id');
    }


    public function programmesemaines()
    {
        return $this->belongsToMany(Programmesemaine::class,'programmesemaines_cahiertextes','prgSemaine_id','cahiertexte_id')
        ->withTimestamps();
    }

    public function programmeMatieres()
    {
        return $this->belongsToMany(programme_matiere::class,'cahiertextes_programmematieres','prgMatiere_id','cahiertexte_id')
        ->withTimestamps();
    }
}
