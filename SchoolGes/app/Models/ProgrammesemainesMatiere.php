<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammesemainesMatiere extends Model
{
    use HasFactory;
    protected $fillable = ['prgSemaine_id','matiere_id'];
}
