<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;


    public function eleves()
    {
        return $this->belongsToMany(Eleve::class,'eleves_groupes','eleve_id','groupe_id')->withTimestamps();;
    }
}
