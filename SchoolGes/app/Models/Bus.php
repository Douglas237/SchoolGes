<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_bus',
        'capaciter',
        'chauffeur',
        'description',
    ];
    public function zones()
    {
        return $this->belongsToMany(Zone::class,'bus_zones','zones_id','bus_id')->withTimestamps();;
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class,'bus_eleves','bus_id','eleve_id')->withTimestamps();;
    }
}
