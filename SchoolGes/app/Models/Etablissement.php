<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'admincirconscription_id', 'chefetablissement_id', 'adress_postal', 'abreviation_nom', 'devise', 'logo', 'adresse_email', 'telephone', 'siege_sociale'];

    public function cantines(){

        return $this->hasMany(Cantine::class, 'etablissement_id', 'id');
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'eleves_etablissements', 'etablissement_id', 'eleve_id')->withTimestamps();
    }

    public function sequences()
    {
        return $this->belongsToMany(Sequence::class,'etablissement_sequence','etablissement_id','sequence_id');
    }

    public function periodes()
    {
        return $this->hasMany(Periode::class,'periode_id','id')->withTimestamps();
    }

    public function cachets()
    {
        return $this->hasMany(Cachet::class,'etablissement_id','id')->withTimestamps();
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class,'etablissement_id','id')->withTimestamps();
    }
    public function controles()
    {
        return $this->hasMany(Controle::class,'etablissement_id', 'id')->withTimestamps();
    }

    public function ateliers()
    {
        return $this->hasMany(Atelier::class,'etablissement_id', 'id')->withTimestamps();
    }
    public function complexsportif()
    {
        return $this->hasMany(ComplexSportif::class,'etablissement_id', 'id')->withTimestamps();
    }
    public function clubeleves()
    {
        return $this->hasMany(ClubEleve::class,'etablissement_id', 'id')->withTimestamps();
    }
    public function niveauenseigs()
    {
        return $this->belongsToMany(NiveauEnseignement::class, 'etablissement_niveauenseigs', 'etablissement_id','niveauenseignement_id')->withTimestamps();
    }

    public function admincirconscription ()
    {
        return $this->belongsTo(Admincirconscription::class, 'admincirconscription_id', 'id');
    }

    public function chefEtablissements ()
    {
        return $this->belongsTo(Chefetablissement::class, 'chefetablissement_id', 'id');
    }
    public function blocsalle()
    {
        return $this->hasMany(BlocSalle::class,'etablissement_id', 'id')->withTimestamps();
    }
    public function jours()
    {
        return $this->hasMany(NombreJours::class,'etablissement_id', 'id')->withTimestamps();
    }

    // public function classes()
    // {
    //     return $this->belongsToMany(Classe::class,'classes_etablissements','classes_id','ets_id')->withTimestamps();
    // }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'etablissement_id', 'id');
    }

}
