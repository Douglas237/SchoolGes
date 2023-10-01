<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $fillable = [
        'NUM_PERIODE',
        'libeller',
        'HEURE_DEBUT',
        'HEURE_FIN',
        'valeur_reelle',
        'pause',
        'description',
        'etablissementId',
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class,'etablissementId','id');
    }

    public function programmesalle(){
        return $this->belongsTo(ProgrammeSalle::class, 'sallebase_id','periode_id', 'id');
    }
    public function nombrejours()
    {
        return $this->belongsToMany(NombreJours::class,'jour_periodes','jour_id','periode_id')->withTimestamps();
    }
}
