<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cantine extends Model
{
    use HasFactory;

    protected $fillable = ['nom','stand','etablissement_id'];

    public function etablissement(){
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id');
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'cantines_produits', 'cantine_id', 'produit_id')->withTimestamps();
    }
}
