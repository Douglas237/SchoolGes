<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_classe',
        'description',
        'code_classe',
        'classesyst_id',
        'etablissement_id'
    ];
    public function livresProgrammes()
    {
        return $this->belongsToMany(livreProgramme::class,'classe_livresprogramme','classe_id','livresprogramme_id')->withTimestamps();
    }

    public function Paiements()
    {
        return $this->belongsToMany(Paiement::class,'classes_paiements','paiement_id','classe_id')->withTimestamps();
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class, 'classe_id', 'id');
    }

    public function bus()
    {
        return $this->belongsToMany(Zone::class,'bus_zones','zones_id','bus_id')->withTimestamps();
    }

    public function salleclasses()
    {
        return $this->hasMany(SalleClasse::class, 'classe_id','id')->withTimestamps();
    }



    // public function etablissements()
    // {
    //     return $this->belongsToMany(Etablissement::class,'classes_etablissements','classes_id','ets_id')->withTimestamps();;
    // }

    public function notes()
    {
        return $this->hasMany(Note::class,'classe_id', 'id');
    }

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'classe_id', 'id');
    }

    public function classesystems ()
    {
        return $this->belongsTo(ClasseSystem::class, 'classesyst_id', 'id');
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id','id');
    }
}
