<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableComplex extends Model
{
    use HasFactory;
    protected $fillable = ['enseignant_id','complexsportif_id','fonction_id'];

    public function fonctions()
    {
        return $this->belongsToMany(Fonction::class, 'responsable_ateliers', 'fonction_id', 'complexsportif_id','enseignant_id')->withTimestamps();
    }
    public function complexsportifs()
    {
        return $this->belongsToMany(ComplexSportif::class, 'responsable_ateliers', 'fonction_id', 'complexsportif_id','enseignant_id')->withTimestamps();
    }
    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'responsable_ateliers', 'fonction_id', 'complexsportif_id','enseignant_id')->withTimestamps();
    }
}
