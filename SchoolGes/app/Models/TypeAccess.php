<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAccess extends Model
{
    use HasFactory;
    protected $fillable = [
        'acces_validation',
        'validite',
        'description',
    ];
}
