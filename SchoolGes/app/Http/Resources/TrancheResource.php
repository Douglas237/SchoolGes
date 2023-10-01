<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Paiement;

class TrancheResource extends JsonResource
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
            'NUM_TRANCHE' => $this->NUM_TRANCHE,
            'LIBELER' => $this->LIBELER,
            'MONTANT' => $this->MONTANT,
            'DATE_FIN' => $this->DATE_FIN,
            'description' => $this->description,
            'paiement_id' => Paiement::where('id',$this->paiement_id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
