<?php

namespace App\Models;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'photo',
        'genre',
        'telephone',
        'date_naissance',
        'lieu_naissance',
        'region_origine',
        'lieu_origine',
        'salleclasse_id',
        'classe_id',

    ];

    public function etablissements()
    {
        return $this->belongsToMany(Etablissement::class, 'eleves_etablissements', 'eleve_id', 'etablissement_id'
        )->withTimestamps();
    }

    public function fichediciplinaires()
    {
        return $this->hasMany(Fichediciplinaire::class, 'eleve_id', 'id');
    }




    public function insolvabilites()
    {
        return $this->hasMany(Insolvabiliter::class, 'eleve_id', 'id');
    }

    public function fichepresencejours()
    {
        return $this->belongsTo(FichePresenceJour::class, 'eleve_id', 'id');
    }
    public function clubeleves()
    {
        return $this->belongsToMany(ClubEleve::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class,'eleve_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(ParentE::class, 'parent_id', 'id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id', 'id');
    }
    public function salleClasse()
    {
        return $this->belongsTo(SalleClasse::class, 'salleclasse_id', 'id');
    }


    public function bus()
    {
        return $this->belongsToMany(Bus::class,'bus_eleves','bus_id','eleve_id')->withTimestamps();
    }


    public function groupes()
    {
        return $this->belongsToMany(Groupe::class,'eleves_groupes','eleve_id','groupe_id')->withTimestamps();;
    }

    public function paiements()
    {
        return $this->belongsToMany(Eleve::class,'eleves_paiements','paiement_id','eleve_id')->withPivot('montant_payer','date','tranche')
        ->withTimestamps();
    }

}
