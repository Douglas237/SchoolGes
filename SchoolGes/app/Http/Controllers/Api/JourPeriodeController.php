<?php

namespace App\Http\Controllers\Api;

use App\Models\Periode;
use App\Models\JourPeriode;
use App\Models\NombreJours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJourPeriodeRequest;
use App\Http\Requests\UpdateJourPeriodeRequest;

class JourPeriodeController extends Controller
{
    // liste des jours et leur periode

    public function index()
    {
        $jp = JourPeriode::join('nombre_jours', 'nombre_jours.id','=','jour_periodes.jour_id')
         ->join('periodes', 'periodes.id', '=', 'jour_periodes.periode_id')
        ->get([
            "jour_periodes.*","nombre_jours.jours","periodes.libeller as libeller_periode"
        ]);
        //dd($jp);

        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des jours et leur periodes',
            'data' => $jp
        ]);
    }

    // attachement des periodes a un jour

    public function store(StoreJourPeriodeRequest $request)
    {
        try {
            $jour = NombreJours::findOrfail($request->jour_id);
            $jour->periodes()->attach($request->periode_id);


            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'jours et ses periodes',
                'data' => $jour
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // detacher une periode d'un jour
    public function detacherjour(StoreJourPeriodeRequest $request, $id)
    {
        try {
            $jp = JourPeriode::Find($id);
            $jour = NombreJours::findOrFail($request->jour_id);
            $jour->periodes()->detach($jp->periode_id);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'detachement effectuer avec succes',
                'data' => $jour
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e);
        }
    }
    // detaile d'un jours et de sa periode

    public function show($id)
    {
        try {
            if(!$id){
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'choix non existant'
                ]);

            } else {

                $jp = Periode::join('jour_periodes','periodes.id','=','jour_periodes.periode_id')
                ->join('nombre_jours','nombre_jours.id','=','jour_periodes.jour_id')
                ->where('jour_id',$id)
                ->get([
                    'jour_periodes.*','nombre_jours.jours','periodes.libeller','periodes.HEURE_DEBUT','periodes.HEURE_FIN'
                ]);

                //dd($jp);
                return response()->json([
                    'status_message' => 'detail du jour et ses periodes',
                    'data' => $jp
                ]);

            }

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }



    //selection des periodes d'un etablissement
    public function selectperiode()
    {
        try {
            $periode = Periode::distinct('etablissements','etablissements.id','=','periodes.etablissement_id')
                             ->get(['libeller','HEURE_DEBUT','HEURE_FIN']);

            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'periode de mon etablissement',
                'data' => $periode
            ]);

        }catch (\Exception $e)
        {
            return response()->json($e);
        }

    }

        //selection des jours d'un etablissement
        public function selectjours()
        {
            try {
                $jours = NombreJours::distinct('etablissements','etablissements.id','=','nombre_jours.etablissement_id')
                                 ->get('jours');

                return response()->json([
                    'statut_code' => 200,
                    'statut_message' => 'les jours definit dans de mon etablissement',
                    'data' => $jours
                ]);

            }catch (\Exception $e)
            {
                return response()->json($e);
            }

        }

}
