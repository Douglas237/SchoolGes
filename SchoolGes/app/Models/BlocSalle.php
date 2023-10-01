<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlocSalle extends Model
{
    use HasFactory;

    protected $fillable = ['num_bloc','libelle','description','etablissement_id'];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id')->withTimestamps();
    }

    public function salleclasses()
    {
        return $this->hasMany(SalleClasse::class, 'salleclasse_id', 'id')->withTimestamps();
    }
}
