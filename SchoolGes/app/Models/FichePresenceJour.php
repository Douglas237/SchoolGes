<?php

namespace App\Models;

use App\Models\Eleve;
use App\Models\SalleBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class FichePresenceJour extends Model
{
    use HasFactory;

    protected $fillable = ['sallebase_id','eleve_id','jours','description'];

    public function sallebases()
    {
        return $this->hasMany(SalleBase::class, 'sallebase_id', 'id')->withTimestamps();
    }

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'eleve_id', 'id')->withTimestamps();
    }
}
