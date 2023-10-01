<?php

namespace App\Models;

use App\Models\TypePaiement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_totale',
        'Avance',
        'tranches',
        'moratoire',
        'description',
        'type_paiement_id'
    ];



    public function classes()
    {
        return $this->belongsToMany(Classe::class,'classes_paiements','paiement_id','classe_id')->withTimestamps();;
    }



    public function eleves()
    {
        return $this->belongsToMany(Eleve::class,'eleves_paiements','paiement_id','eleve_id')->withPivot('montant_payer','date','tranche')
        ->withTimestamps();
    }

    public function Typepaiements()
    {
        return $this->belongsToMany(TypePaiement::class,'paiements_typepaiements','type_paiement_id','paiement_id')->withTimestamps();;
    }


    public function Typepayement()
    {
        return $this->belongsTo(TypePaiement::class, 'type_paiement_id', 'id');
    }
}
