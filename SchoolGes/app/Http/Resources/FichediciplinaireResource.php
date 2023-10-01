<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FichediciplinaireResource extends JsonResource
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
            'eleve_id' => $this->eleve_id,
            'sanction' => $this->sanction,
            'motif' => $this->motif,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'description' => $this->description,
        ];
    }
}
