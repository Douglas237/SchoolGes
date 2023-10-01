<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Admincirconscription;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Chefetablissement extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'chef_etablissement';

    protected $fillable = [
        'name',
        'email',
        'password',
        'admincirconscription_id',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'region_naissance',
        'cni',
        'ville_residence',
        'pays',
        'telephone',
        'image',
        'sexe',
        'adresse',
        'description',
    ];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function admincirconscription()
    {
        return $this->belongsTo(Admincirconscription::class, 'admincirconscription_id', 'id');
    }

    public function etablissements()
    {
        return $this->hasMany(Etablissement::class, 'chefetablissement_id', 'id');
    }
}
