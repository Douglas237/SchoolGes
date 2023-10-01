<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeAcademique extends Model
{
    use HasFactory;

    protected $fillable = ['intitule','date_debut','date_fin','description'];

    public function emploitemps()
    {
        return $this->hasMany(EmploiTemp::class,'anneeacademiq_id', 'id');
    }

}
