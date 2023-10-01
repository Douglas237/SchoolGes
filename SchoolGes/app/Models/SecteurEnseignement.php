<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurEnseignement extends Model
{
    use HasFactory;
    protected $fillable = [
        'libeller',
        'description',
    ];
}
