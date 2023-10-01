<?php

namespace App\Http\Resources;

use App\Models\Bus;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusEleveResource extends JsonResource
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
            'bus_id' => Bus::where('id',$this->classe_id)->get(),
            'eleve_id' => Eleve::join('type_paiements', 'paiements.type_paiement_id', '=', 'type_paiements.id')
                                        ->where('eleves.id',$this->eleve_id)
                                        ->join('bus_zones','bus_zones.zones_id','=','bus_zones.id')
                                        ->where('zones.id',$this->zones_id)
                                        ->join('buses','buses.bus_id','=','buses.id')

                                        ->get([
                                            'paiements.id as idpaiement',
                                            'paiements.type_paiement_id as idtypepaiement',
                                            'paiements.montant_totale',
                                            'type_paiements.NOM_TYPE',
                                            'bus_zones.zones_id as id*zones',
                                            'zones.id',
                                            'zones.nom_zone',
                                            'buses.id',
                                            'buses.nom_bus',
                                            'eleves.nom',
                                        ])->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
