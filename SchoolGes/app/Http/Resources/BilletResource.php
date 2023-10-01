<?php

namespace App\Http\Resources;

use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BilletResource extends JsonResource
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
            'CLASSE' => $this->CLASSE,
            'SALLE' => $this->SALLE,
            'MOTIF' => $this->MOTIF,
            'description' => $this->description,
            'eleve_id' => Eleve::where('id',$this->eleve_id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
