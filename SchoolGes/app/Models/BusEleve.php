<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusEleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'eleve_id',
    ];
}
