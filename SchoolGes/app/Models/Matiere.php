<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'etablissement_id',
        'matieresyst_id',
        'code_matiere',
        'intituler_etablissement',
        'volumehoraire_etablissement',
        'coefficient_etablissement',
        'description',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id', 'id');
    }

    public function enseignants()
    {
        return $this->hasMany(Enseignant::class, 'id_matiere', 'id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'matiere_id', 'id');
    }

    public function emploitemps()
    {
        return $this->hasMany(EmploiTemp::class,'matiere_id', 'id');
    }
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id')->withTimestamps();
    }


    public function programeSemaines()
    {
        return $this->belongsToMany(Programmesemaine::class,'programmesemaines_matieres','prgSemaine_id','matiere_id')
        ->withTimestamps();
    }
}
