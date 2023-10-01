<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prix', 'description'];

    public function cantines()
    {
        return $this->belongsToMany(Cantine::class, 'cantines_produits', 'produit_id', 'cantine_id')->withTimestamps();
    }
}
