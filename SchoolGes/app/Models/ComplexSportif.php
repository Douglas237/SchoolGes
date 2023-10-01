<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexSportif extends Model
{
    use HasFactory;

    protected $fillable = ['nom_complex_sportifs', 'date_creation', 'description','etablissement_id'];
    public function evenementsportifs()
    {
        return $this->hasMany(EvenementSportif::class, 'complexsportif_id', 'id')->withTimestamps();
    }

    public function etablissements()
    {
        return $this->belongsTo(Etablissement::class,'etablissement_id', 'id')->withTimestamps();
    }

    public function responsablecomplex()
    {
        return $this->belongsToMany(ResponsableComplex::class, 'responsable_ateliers', 'fonction_id', 'complexsportif_id','enseignant_id')->withTimestamps();
    }
}
