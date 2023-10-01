<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CahiertextesProgrammematieres extends Model
{
    use HasFactory;
    protected $fillable = ['prgMatiere_id','cahiertexte_id'];
}
