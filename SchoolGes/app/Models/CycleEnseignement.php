<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CycleEnseignement extends Model
{
    use HasFactory;

    protected $fillable = ['admincirconscription_id','intituler','categories','description'];

    public function matieresystem()
    {
        return $this->hasMany(MatiereSystem::class, 'cycleenseignemt_id', 'id');
    }
}
