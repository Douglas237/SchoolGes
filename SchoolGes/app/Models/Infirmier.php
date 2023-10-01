<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infirmier extends Model
{
    use HasFactory;

    protected $fillable = [
        'infirmerie_id',
        'nom',
        'prenom',
        'date_naissance',
    ];

    public function infirmerie ()
    {
        return $this->belongsTo(Infirmerie::class, 'infirmerie_id', 'id');
    }
}
