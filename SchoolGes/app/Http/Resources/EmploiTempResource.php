<?php

namespace App\Http\Resources;

use App\Models\EmploiTemp;
use App\Models\JourPeriode;
use App\Models\NombreJours;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmploiTempResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //dd($this->resource);
        return [
            'resource' =>EmploiTemp::all()
        ,
            // [JourPeriode::join('nombre_jours','nombre_jours.id','=','jour_periodes.jour_id')],
            // [EmploiTemp::join('periodes','jour_periodes.id','=','jour_periodes.periode_id')
            // ->where('jourperiode_id',$this->jourperiode_id)
            // ->get()],
        ];
    }
}
