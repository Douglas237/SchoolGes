<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatiereResource extends JsonResource
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
            'classe_id' => $this->classe_id,
            'matieresyst_id' => $this->matieresyst_id,
            'code_matiere' => $this->code_matiere,
            'intituler_etablissement' => $this->intituler_etablissement,
            'volumehoraire_etablissement' => $this->volumehoraire_etablissement,
            'coefficient_etablissement' => $this->coefficient_etablissement,
            'description' => $this->description,
        ];
    }
}
