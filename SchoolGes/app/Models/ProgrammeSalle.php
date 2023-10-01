<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeSalle extends Model
{
    use HasFactory;

    protected $fillable = ['periode_id','sallebase_id','jours','description'];

    public function sallebases()
    {
        return $this->hasMany(SalleBase::class, 'sallebase_id', 'id')->withTimestamps();
    }

    public function periodes()
    {
        return $this->hasMany(Periode::class, 'periode_id', 'id')->withTimestamps();
    }
}
