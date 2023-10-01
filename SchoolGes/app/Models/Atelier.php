<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atelier extends Model
{
    use HasFactory;
    protected $fillable = ['nom_atelier','description','capacite','etablissement_id'];

    public function ressources()
    {
        return $this->hasMany(Ressource::class,'atelier_id','id')->withTimestamps();
    }
    // public function atelierressources()
    // {
    //     return $this->belongsToMany(AtelierRessource::class, 'atelier_id','ressource_id');
    // }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id')->withTimestamps();
    }

    public function responsableatelier()
    {
        return $this->belongsToMany(ResponsableAtelier::class, 'responsable_ateliers', 'fonction_id', 'atelier_id','enseignant_id')->withTimestamps();
    }
}
