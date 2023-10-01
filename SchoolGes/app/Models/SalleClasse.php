<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleClasse extends Model
{
    use HasFactory;

    protected $fillable = ['code_salle_classe', 'intitule_salle', 'description','classe_id','blocsalle_id'];



    public function classes()
    {
        return $this->belongsTo(Classe::class, 'classe_id','id')->withTimestamps();
    }


    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'salleclasse_id', 'id');
    }

    public function postes()
    {
        return $this->belongsToMany(Poste::class,'salleclasse_posteeleves','poste_id','salleclaasse_id')->withTimestamps();;
    }
/* ---------------------Ajout de notes ---------------------------------------------- */
    public function notes()
    {
        return $this->hasMany(Note::class,'salleclass_id', 'id');
    }

    public function emploitemps()
    {
        return $this->hasMany(EmploiTemp::class,'salleclasse_id', 'id');
    }

    public function cahiertext(){
        return $this->belongsTo(CahierTexte::class, 'salleClasse_id','matiere_id', 'id');
    }
}
