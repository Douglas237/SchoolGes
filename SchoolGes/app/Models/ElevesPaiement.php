<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElevesPaiement extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_payer',
        'date',
        'statut_insolvabilite',
        'statut_classe',
        'statut_etablissement',
        'tranche',
        'paiement_id',
        'eleve_id',
    ];
}
