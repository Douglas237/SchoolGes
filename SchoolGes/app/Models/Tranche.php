<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranche extends Model
{
    use HasFactory;

    public function moratoire()
    {
        return $this->belongsTo(Moratoire::class, 'tranche_id', 'id');
    }
}
