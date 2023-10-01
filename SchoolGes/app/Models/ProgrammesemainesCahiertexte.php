<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammesemainesCahiertexte extends Model
{
    use HasFactory;

    protected $fillable = ['prgSemaine_id','cahiertexte_id'];
}
