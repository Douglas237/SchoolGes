<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insolvabiliter extends Model
{
    use HasFactory;
    protected $fillable = [
        'eleve_id',
        'date_debut',
        'date_fin',
        'periode_debut',
        'periode_fin',
        'description',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id', 'id');
    }
}
