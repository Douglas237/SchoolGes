<?php

namespace App\Http\Resources;

use App\Models\Classe;
use App\Models\ParentE;
use App\Models\SalleClasse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EleveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'photo' => $this->zone,
            'genre' => $this->genre,
            'telephone' => $this->telephone,
            'date_naissance' => $this->date_naissance,
            'lieu_naissance' => $this->lieu_naissance,
            'region_origine' => $this->region_origine,
            'lieu_origine' => $this->lieu_origine,
            'parent_id' => ParentE::where('parents.id',$this->parent_id),
            'salleclasse_id' => SalleClasse::where('id',$this->salleclasse_id)->get(),
            'classe_id' => Classe::where('id',$this->classe_id)->get(),
        ];
    }
}
