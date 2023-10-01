<?php

namespace App\Http\Resources;

use App\Models\TypePaiement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaiementResource extends JsonResource
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
            'type_paiement_id' => TypePaiement::where('id',$this->type_paiement_id)->get(),
            'montant_totale' => $this->montant_totale,
            'Avance' => $this->Avance,
            'tranches' => $this->tranches,
            'moratoire' => $this->moratoire,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
