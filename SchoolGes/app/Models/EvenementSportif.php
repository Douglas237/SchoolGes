<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementSportif extends Model
{
    use HasFactory;

    protected $fillable = ['complexsportif_id', 'nom_evenement', 'description','date_debut','date_fin','heure_debut','heure_fin'];

    public function complexsportif()
    {
        return $this->belongsTo(ComplexSportif::class, 'complexsportif_id', 'id');
    }
}
