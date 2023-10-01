<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controle extends Model
{
    use HasFactory;

    protected $fillable = ['num_controle','date_controle','semaine_controle','description','jour','sequence_id'];

    public function sequences()
    {
        return $this->belongsTo(Sequence::class, 'sequence_id', 'id');
    }
}
