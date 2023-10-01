<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        "trimestre_id",
        "sequence_id",
        "salleclasse_id",
        "eleve_id",
        "classe_id",
        "matiere_id",
        "enseignant_id",
        "note"
    ];

    // protected $guarded = [];

    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class, 'trimestre_id', 'id');
    }
    public function sequence()
    {
        return $this->belongsTo(Sequence::class, 'sequence_id', 'id');
    }
    public function salleclasse()
    {
        return $this->belongsTo(SalleBase::class, 'salleclass_id', 'id');
    }
    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id', 'id');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id', 'id');
    }
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id', 'id');
    }
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'enseignant_id', 'id');
    }
}
