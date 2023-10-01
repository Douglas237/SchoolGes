<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AtelierRessource extends Model
{
    use HasFactory;

    // public function ateliers()
    // {
    //     return $this->belongsToMany(Atelier::class);
    // }
    // public function ressources()
    // {
    //     return $this->belongsToMany(Ressource::class);
    // }

    // public function down():void
    // {
    //     Schema::dropIfExists('atelier_ressources');
    // }
}
