<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivreProgramme extends Model
{
    use HasFactory;
    protected $fillable = [
        'TITRE_LIVRE',
        'DOMAINE',
        'GROUPEMENT',
        'EDITION',
        'hauteur',
        'description',
    ];

    public function classes()
    {
        return $this->belongsToMany(Classe::class,'classe_livresprogramme','classe_id','livresprogramme_id');
    }
}
