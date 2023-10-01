<?php

namespace App\Models;

use App\Models\SalleBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fourniture extends Model
{
    use HasFactory;

    protected $fillable = ['libelle','quantiter','description'];

    public function sallebases()
    {
        return $this->hasMany(SalleBase::class, 'sallebase_id', 'id');
    }

}
