<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programme_matiere extends Model
{
    use HasFactory;

    protected $fillable = ['admincirconscription_id','matieresyst_id','num_lecon','intituler_lecon','volume_horaire','description'];

    public function matieresys()
    {
        return $this->hasOne(MatiereSystem::class,'matieresyst_id')->withTimestamps();
    }
    public function admincirconscription ()
    {
        return $this->belongsTo(Admincirconscription::class, 'admincirconscription_id', 'id')->withTimestamps();
    }


    public function cahiersTextes()
    {
        return $this->belongsToMany(CahierTexte::class,'cahiertextes_programmematieres','prgMatiere_id','cahiertexte_id')
        ->withTimestamps();
    }
}
