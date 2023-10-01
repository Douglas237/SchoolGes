<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description'];


    public function salleClasses()
    {
        return $this->belongsToMany(SalleClasse::class,'salleclasse_posteeleves','poste_id','salleclaasse_id')->withTimestamps();;
    }
}
