<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentE extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_parent',
        'telephone',
        'CNI',
        'email',
        'lieu_residence',
        'photo',
        'user_name',

    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'parent_id', 'id');
    }
}
