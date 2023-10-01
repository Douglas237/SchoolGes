<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
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
        'description',
    ];
}
