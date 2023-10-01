<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infirmerie extends Model
{
    use HasFactory;

    protected $fillable = ['nom_infirmerie', 'description'];

    public function fichesantes ()
    {
        return $this->hasMany(Fichesante::class, 'infirmerie_id', 'id')->withTimestamps();
    }

    public function infirmiers ()
    {
        return $this->hasMany(Infirmier::class, 'infirmerie_id', 'id')->withTimestamps();
    }
}
