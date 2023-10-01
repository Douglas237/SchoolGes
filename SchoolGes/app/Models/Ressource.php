<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;
    protected $fillable = ['nom_ressource','description','quantiter', 'atelier_id'];

    public function ateliers()
    {
        return $this->belongsTo(Atelier::class,'atelier_id','id')->withTimestamps();
    }
    // public function atelierressources()
    // {
    //     return $this->belongsToMany(AtelierRessource::class, 'atelier_id','ressource_id');
    // }
}
