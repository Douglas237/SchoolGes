<?php

namespace App\Http\Resources;

use App\Models\Enseignant;
use App\Models\SalleClasse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgrammesemaineResource extends JsonResource
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
            'num_programme' => $this->num_programme,
            'semaine_programme' => $this->semaine_programme,
            'jour' => $this->zone,
            'date' => $this->date,
            'heure_debut' => $this->heure_debut,
            'heure_fin' => $this->heure_fin,
            'salleClasse_id' => SalleClasse::where('parents.id',$this->salleClasse_id),
            'enseignant_id' => Enseignant::where('id',$this->enseignant_id)->get(),
        ];
    }
}
