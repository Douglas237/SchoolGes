<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtablissementNiveauenseig extends Model
{
    use HasFactory;

    protected $fillable = ['numero_autorisation', 'adress_email','numero_telephone','etablissement_id','niveauenseignement_id'];
}
