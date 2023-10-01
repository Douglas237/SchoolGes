<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseSystem extends Model
{
    use HasFactory;

    protected $fillable = ['admincirconscription_id','intituler_generale','code_classe_system','description'];

    public function admincirconscription ()
    {
        return $this->belongsTo(Admincirconscription::class, 'admincirconscription_id', 'id');
    }

    public function matieresystems()
    {
        return $this->belongsToMany(MatiereSystem::class,'matiersys_classesys','matieresyst_id','classesyst_id');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'classesyst_id', 'id');
    }
}
