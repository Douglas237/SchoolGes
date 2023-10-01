<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichediciplinaire extends Model
{
    use HasFactory;

    protected $fillable = ['eleve_id', 'sanction','motif','date_debut','date_fin','description'];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id', 'id');
    }
}
