<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = ['etablissement_id', 'poste', 'cni', 'scan_signature'];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class, 'etablissement_id', 'id')->withTimestamps();
    } 
}
