<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleclassePosteeleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'poste_id',
        'salleclaasse_id',
    ];
}
