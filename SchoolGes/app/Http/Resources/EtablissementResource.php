<?php

namespace App\Http\Resources;

use App\Models\Chefetablissement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EtablissementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          "id" => $this->id,
          "nom" => $this->nom,
          "propietaire" => Chefetablissement::where('id',$this->chefetablissement_id)->get('name'),
          "description" => $this->description,
          "adress_postal" => $this->adress_postal,
          "abreviation_nom" => $this->abreviation_nom,
          "devise" => $this->devise,
          "logo" => $this->logo,
          "adresse_email" => $this->adresse_email,
          "telephone" => $this->telephone,
          "siege_sociale" => $this->siege_sociale,
          "chefetablissement_id" => $this->chefetablissement_id,
        ];
    }
}
