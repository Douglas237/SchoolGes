<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moratoire extends Model
{
    use HasFactory;

    protected $fillable = [
    'tranche_id',
    'numero_moratoire',
    'motif',
    'description',
    'date_prorogation'];

    public function tranches()
    {
        return $this->hasMany(Tranches::class,'tranche_id', 'id')->withTimestamps();
    }
}
