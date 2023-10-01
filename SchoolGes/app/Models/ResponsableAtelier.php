<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableAtelier extends Model
{
    use HasFactory;

    protected $fillable = ['enseignant_id','atelier_id','fonction_id'];

    public function fonctions()
    {
        return $this->belongsToMany(Fonction::class, 'responsable_ateliers', 'fonction_id', 'atelier_id','enseignant_id')->withTimestamps();
    }
    public function ateliers()
    {
        return $this->belongsToMany(Atelier::class, 'responsable_ateliers', 'fonction_id', 'atelier_id','enseignant_id')->withTimestamps();
    }
    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'responsable_ateliers', 'fonction_id', 'atelier_id','enseignant_id')->withTimestamps();
    }
}
