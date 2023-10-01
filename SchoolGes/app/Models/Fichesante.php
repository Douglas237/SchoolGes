<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichesante extends Model
{
    use HasFactory;

    protected $fillable = ['infirmerie_id', 'etat', 'description'];

    public function infirmerie()
    {
        return $this->belongsTo(Infirmerie::class, 'infirmerie_id', 'id');
    }
}
