<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiTemp extends Model
{
    use HasFactory;

    protected $fillable = ['sallebase_id','salleclasse_id','matiere_id','jourperiode_id',
    'anneeacademiq_id','libelle','type','date_debut','date_fin','enseignant_id'];

    public function sallebase()
    {
        return $this->belongsTo(SalleBase::class, 'sallebase_id', 'id');
    }
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id', 'id');
    }
    public function anneeacademique()
    {
        return $this->belongsTo(AnneeAcademique::class, 'anneeacademiq_id', 'id');
    }
    public function jourperiode()
    {
        return $this->belongsTo(JourPeriode::class, 'jourperiode_id', 'id');
    }
    public function salleclasse()
    {
        return $this->belongsTo(SalleClasse::class, 'salleclasse_id', 'id');
    }
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'enseignant_id', 'id');
    }

}
