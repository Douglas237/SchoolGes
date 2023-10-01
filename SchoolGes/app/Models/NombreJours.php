<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NombreJours extends Model
{
    use HasFactory;
    protected $fillable = ['jours', 'description','etablissement_id'];

    public function periodes()
    {
        return $this->belongsToMany(Periode::class,'jour_periodes','jour_id','periode_id')->withTimestamps();
    }
    public function etablissements()
    {
        return $this->belongsTo(Etablissement::class,'etablissement_id', 'id')->withTimestamps();
    }
}
