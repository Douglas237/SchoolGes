<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;
    protected $fillable = [
        'NOM',
        'PRENOM',
        'DATE_NAISSANCE',
        'REGION_ORIGINE',
        'LIEU_NAISSANCE',
        'ADRESSE',
        'CNI',
        'VILLE_RESIDENCE',
        'PAYS',
        'TELEPHONE',
        'EMAIL',
        'IMAGE',
        'SEXE',
        'id_typeEnseignant',
        'id_matiere',
        'description',
    ];
    public function responsableatelier()
    {
        return $this->belongsToMany(ResponsableAtelier::class, 'responsable_ateliers', 'fonction_id', 'atelier_id','enseignant_id')->withTimestamps();
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere', 'id');
    }

    public function typeEnseignement()
    {
        return $this->belongsTo(TypeEnseignant::class, 'id_typeEnseignant', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'enseignant_id', 'id');
    }
    public function emploitemps()
    {
        return $this->hasMany(EmploiTemp::class,'enseignant_id', 'id');
    }
}
