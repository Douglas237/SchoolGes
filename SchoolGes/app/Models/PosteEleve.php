<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosteEleve extends Model
{
    use HasFactory;
    public function Ssecondaires()
    {
        return $this->belongsToMany(SalleClasse::class, 'posteleves__salleclasses', 'posteleve_id', 'id_salle_classe')->withTimestamps();
    }
}
