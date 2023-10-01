<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materieldidactique extends Model
{
    use HasFactory;

    protected $fillable =['nom', 'description'];
}
