<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleBase extends Model
{
    use HasFactory;

    protected $fillable = ['code_salle','intitule_salle','capacite_salle','tronc_commun','nombre_tronc','description','etablissement_id'];

    public function fichepresencejours()
    {
        return $this->belongsTo(FichePresenceJour::class, 'sallebase_id', 'id');
    }

    public function programmesalle(){
        return $this->belongsTo(ProgrammeSalle::class, 'sallebase_id','periode_id', 'id');
    }
    public function fourniture()
    {
        return $this->belongsTo(Fourniture::class, 'sallebase_id', 'id')->withTimestamps();
    }

    // public function classes()
    // {
    //     return $this->hasMany(Classe::class, 'classe_id', 'id')->withTimestamps();
    // }

    public function etablissements()
    {
        return $this->hasMany(Etablissement::class, 'etablissement_id', 'id')->withTimestamps();
    }
    public function cahiertextes()
    {
        return $this->hasMany(CahierTexte::class, 'sallebase_id', 'id')->withTimestamps();
    }

    public function blocsalle()
    {
        return $this->belongsTo(blocsalle::class, 'salleclasse_id', 'id')->withTimestamps();
    }

    public function emploitemps()
    {
        return $this->hasMany(EmploiTemp::class,'sallebase_id', 'id');
    }

}
