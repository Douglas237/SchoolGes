<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCahierAppelRequest;
use App\Models\CahierAppel;
use App\Models\Eleve;
use App\Models\NombreJours;
use App\Models\Periode;
use App\Models\SalleClasse;
use Illuminate\Http\Request;

class CahierAppelController extends Controller
{
    // selection des eleves de la salle de classe

    public function selecteleve(Request $request, $id)
    {
        try {
            $salle = Eleve::find($id);
            // $eleve = Eleve::join('salle_classes', 'salle_classes.id','=', $salle)
            // ->WHERE('eleves.salleclasse_id','=','salle_classes.id')
            // ->get(
            //     'eleves.*'
            // );
            $eleve = SalleClasse::join('eleves', 'eleves.id', '=', $salle)
                ->WHERE('eleves.salleclasse_id', '=', 'salle_classes.id')
                ->get(
                    'eleves.*'
                );
            dd($eleve);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'liste des eleves de la salles de classes',
                'data' => $eleve
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
            ]);
        }
    }
    // creation du cahier d'appel des eleves d'une salle de classe

    public function store(StoreCahierAppelRequest $request)
    {
        try {
            //$periode = Periode::where('periodes.id', $request->periode_id)->get();
            $jour = NombreJours::where('nombre_jours.id', $request->jour_id)->get();
            $eleve = Eleve::where('eleves.id', $request->eleve_id)->get();

            if ($jour->isEmpty() || $eleve->isEmpty()) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }

           $cahier = CahierAppel::create($request->validated());

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'responsable ajouté',
                    'data' => $cahier
                ]);

        } catch (\Exception $e) {
        }
    }
}
