<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElevesGroupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'groupe_id',


    ];
}
