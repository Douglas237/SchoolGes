<?php

namespace App\Http\Resources;

use App\Models\Bus;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusZonesResource extends JsonResource
{
    /**n
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'bus_id' => Bus::where('id',$this->classe_id)->get(),
            'zones_id' => Zone::join('type_paiements', 'paiements.type_paiement_id', '=', 'type_paiements.id')
                                        ->where('eleves.id',$this->eleve_id)
                                        ->join('bus_zones','bus_zones.zones_id','=','bus_zones.id')
                                        ->where('zones.id',$this->zones_id)
                                        ->join('eleves','eleves.salleclasse_id','eleves.classe_id','=','eleves.id')
                                        ->where('classes.id',$this->classe_id)
                                        ->join('salle_classes','salle_classes.blocsalle_id','=','salle_classes.id')
                                        ->where('salle_classes.id',$this->salleclasse_id)
                                        ->get([
                                            'paiements.id as idpaiement',
                                            'paiements.type_paiement_id as idtypepaiement',
                                            'paiements.montant_totale',
                                            'type_paiements.NOM_TYPE',
                                            'eleves.classe_id',
                                            'eleves.id',
                                            'eleves.salleclasse_id',
                                            'salle_classes.id',
                                            'salle_classes.intitule_salle',
                                            'classes.id',
                                            'classes.nom_classe',
                                            'eleves.nom',
                                            'bus_zones.zones_id as idzones',
                                            'zones.id',
                                            'zones.nom_zone',
                                        ])->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
