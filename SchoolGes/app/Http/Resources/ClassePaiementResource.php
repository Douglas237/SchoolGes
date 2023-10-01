<?php

namespace App\Http\Resources;

use App\Models\Classe;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassePaiementResource extends JsonResource
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
            'classe_id' => Classe::where('id',$this->classe_id)->get(),
            'paiement_id' => Paiement::join('type_paiements', 'paiements.type_paiement_id', '=', 'type_paiements.id')
                                        ->where('paiements.id',$this->paiement_id)
                                        ->get([
                                            'paiements.id as idpaiement',
                                            'paiements.type_paiement_id as idtypepaiement',
                                            'paiements.montant_totale',
                                            'type_paiements.NOM_TYPE',
                                        ])->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
