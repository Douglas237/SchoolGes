<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourPeriode extends Model
{
    use HasFactory;

    protected $faillable = ['jour_id','periode_id'];

    public function emploitemps()
    {
        return $this->hasMany(EmploiTemp::class,'jourperiode_id', 'id')->withTimestamps();
    }
}
