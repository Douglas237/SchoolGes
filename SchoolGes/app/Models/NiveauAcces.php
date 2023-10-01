<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauAcces extends Model
{
    use HasFactory;
    protected $fillable = [
        'LIBELLER',
        'DATE_CREATION',
        'description',
    ];
}
