<?php

namespace App\Models;


use App\Models\Chefetablissement;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
 
class Admincirconscription extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'admins_circonscription';

    protected $fillable = [
        'name',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'region_naissance',
        'cni',
        'ville_residence',
        'pays',
        'adresse',
        'telephone',
        'image',
        'sexe',
        'description',
        'email',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**lk
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function chefEtablissements()
    {
        return $this->hasMany(Chefetablissement::class, 'admincirconscription_id', 'id');
    }

    public function etablissements()
    {
        return $this->hasMany(Etablissement::class, 'chefetablissement_id', 'id');
    }

    public function matieresystem()
    {
        return $this->hasMany(MatiereSystem::class, 'admincirconscription_id', 'id');
    }
    public function classsystem()
    {
        return $this->hasMany(ClasseSystem::class, 'admincirconscription_id', 'id');
    }

}
