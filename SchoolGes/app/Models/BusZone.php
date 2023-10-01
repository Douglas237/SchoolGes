<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusZone extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id',
        'zones_id',

    ];
}
