<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEnseignement extends Model
{
    use HasFactory;

    protected $fillable = ['admincirconscription_id','intituler','description'];

    public function matieresystem()
    {
        return $this->hasMany(MatiereSystem::class, 'typeenseignemt_id', 'id');
    }
}
