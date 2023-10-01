<?php

namespace App\Models;

use App\Models\Paiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypePaiement extends Model
{
    use HasFactory;


    // public function paiementss()
    // {
    //     return $this->belongsToMany(Paiement::class,'paiements_typepaiements','type_paiement_id','paiement_id')->withTimestamps();;
    // }



    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'type_paiement_id', 'id');
    }
}
