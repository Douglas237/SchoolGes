<?php

namespace App\Http\Resources;

use App\Models\Eleve;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElevePaiementResource extends JsonResource
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
            'montant_payer' => $this->montant_payer,
            'date' => $this->date,
            'heure' => $this->heure,
            'statut_insolvabilite' => $this->statut_insolvabilite,
            'statut_classe' => $this->statut_classe,
            'statut_etablissement' => $this->statut_etablissement,
            'tranche' => $this->tranche,
            'paiement_id' => Paiement::join('type_paiements', 'paiements.type_paiement_id', '=', 'type_paiements.id')
                                        ->where('paiements.id',$this->paiement_id)
                                        ->get([
                                            'paiements.id as idpaiement',
                                            'paiements.type_paiement_id as idtypepaiement',
                                            'paiements.montant_totale',
                                            'type_paiements.NOM_TYPE',
                                        ])->toArray(),
            'eleve_id' => Eleve::where('id',$this->eleve_id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
