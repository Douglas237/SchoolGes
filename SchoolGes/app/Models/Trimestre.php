<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_trimestre',
        'libeller',
        'DEBUT_COURS',
        'FIN_COURS',
        'DEBUT_EVALUATION',
        'FIN_EVALUATION',
        'DEBUT_RESULTAT',
        'FIN_RESULTAT',
        'Debut_Conger',
        'description',
    ];


    public function sequences()
    {
        return $this->hasMany(Sequence::class, 'trimestre_id', 'id')->withTimestamps();
    }

    public function notes()
    {
        return $this->hasMany(Note::class,'trimestre_id', 'id');
    }
}
