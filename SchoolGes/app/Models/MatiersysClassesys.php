<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatiersysClassesys extends Model
{
    use HasFactory;

    protected $faillable = ['matieresyst_id','classesyst_id'];
}
