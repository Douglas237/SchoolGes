<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauEnseignement extends Model
{
    use HasFactory;

    protected $fillable = ['intitule_niveau','type','description'];

    public function etablissements()
    {
        return $this->belongsToMany(Etablissement::class, 'etablissement_niveauenseigs', 'etablissement_id','niveauenseignement_id')->withTimestamps();
    }

    public function matieresystem()
    {
        return $this->hasMany(MatiereSystem::class, 'niveauenseignemt_id', 'id')->withTimestamps();
    }
}
