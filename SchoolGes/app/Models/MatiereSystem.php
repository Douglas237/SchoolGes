<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatiereSystem extends Model
{
    use HasFactory;

    protected $fillable = ['admincirconscription_id','typeenseignemt_id','niveauenseignemt_id',
    'cycleenseignemt_id','intitule_generale','groupement','domaine','type',
    'classification','coefficient_generale','volumehoraire_system','description'];

    public function admincirconscription ()
    {
        return $this->belongsTo(Admincirconscription::class, 'admincirconscription_id', 'id');
    }
    public function typeenseignement()
    {
        return $this->belongsTo(TypeEnseignement::class,'typeenseignemt_id','id')->withTimestamps();
    }
    public function niveauenseigs()
    {
        return $this->belongsTo(NiveauEnseignement::class,'niveauenseignemt_id','id')->withTimestamps();
    }
    public function cycleenseignement()
    {
        return $this->belongsTo(CycleEnseignement::class,'cycleenseignemt_id','id')->withTimestamps();
    }
    public function classesystems()
    {
        return $this->belongsToMany(ClasseSystem::class,'matiersys_classesys','matieresyst_id','classesyst_id');
    }
    public function programmematier()
    {
        return $this->hasOne(programme_matiere::class,'matieresyst_id')->withTimestamps();
    }

}
