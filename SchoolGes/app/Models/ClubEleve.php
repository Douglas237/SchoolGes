<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubEleve extends Model
{
    use HasFactory;
    protected $fillable = ['nom_club','description','etablissement_id'];

        public function eleves()
    {
        return $this->belongsToMany(Eleve::class);
    }
        public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id','id');
    }
}
