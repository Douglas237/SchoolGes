<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_sequences',
        'libeller',
        'DEBUT_COURS',
        'FIN_COURS',
        'DEBUT_EVALUATION',
        'FIN_EVALUATION',
        'DEBUT_RESULTAT',
        'FIN_RESULTAT',
        'trimestre_id',
        'description',
    ];
    public function etablissements()
    {
        return $this->belongsToMany(Etablissement::class,'etablissement_sequence','etablissement_id','sequence_id')->withTimestamps();;
    }
    public function controles()
    {
        return $this->hasMany(Controle::class, 'sequence_id', 'id');
    }


    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class, 'trimestre_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class,'sequence_id', 'id');
    }
}
