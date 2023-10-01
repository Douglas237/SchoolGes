<?php

namespace App\Http\Controllers\Api;

use App\Models\Periode;
use App\Models\EmploiTemp;
use App\Models\JourPeriode;
use App\Models\NombreJours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEmploiTempRequest;
use App\Http\Resources\EmploiTempResource;
use App\Models\SalleClasse;

class EmploiTempsController extends Controller

{
    // programme de la semaine
    public function index($id)
    {
        $emplo = [];
        $gildas = [];

        $salleclasse = SalleClasse::find($id);
        //dd($salleclasse);
        $jour = NombreJours::join('jour_periodes', 'jour_periodes.id', '=', 'jour_periodes.jour_id')
            ->get(['nombre_jours.id', 'nombre_jours.jours'])
            ->toArray();
        for ($i = 0; $i <= count($jour) - 1; $i++)
        {
            $jp = Periode::join('jour_periodes', 'periodes.id', '=', 'jour_periodes.periode_id')
                ->join('emploi_temps', 'emploi_temps.jourperiode_id', '=', 'jour_periodes.id')
                ->join('matieres', 'matieres.id', '=', 'emploi_temps.matiere_id')
                ->join('salle_classes', 'salle_classes.id', '=', 'emploi_temps.salleclasse_id')
                ->where('salleclasse_id',$id)
                ->join('enseignants', 'enseignants.id', '=', 'emploi_temps.enseignant_id')
                ->join('salle_bases', 'salle_bases.id', '=', 'emploi_temps.sallebase_id')
                ->where('jour_id', $jour[$i]['id'])
                ->get([

                    "emploi_temps.*",
                    // 'emploi_temps.jourperiode_id',
                    'matieres.intituler_etablissement as matiere',
                    'enseignants.Nom as enseignant',
                    'salle_bases.code_salle as Salle',
                    'salle_classes.code_salle_classe',
                    //'jour_periodes.id',
                    'periodes.libeller',
                    'periodes.HEURE_DEBUT',
                    'periodes.HEURE_FIN',
                    'periodes.pause'
                ])->toArray();

            array_push($emplo, $jp);
        }

        for ($j = 0; $j <= count($jour) - 1; $j++) {
            $test = [
                'jours' => $jour[$j]['jours'],
                'periode' => $emplo[$j],
            ];

            array_push($gildas, $test);
        }
        //dd($jour);
        return response()->json([
            'data' => $gildas
        ]);
        //dd($emplo);


    }
    // creation de l'emploi de temps d'une journée
    public function store(Request $request)

    {
        $array = array();
        foreach ($request->temp as $temps) {
            $emploitemp = EmploiTemp::create(
                [
                    "sallebase_id" => $temps['sallebase_id'],
                    "matiere_id" => $temps['matiere_id'],
                    "salleclasse_id" => $temps['salleclasse_id'],
                    "jourperiode_id" => $temps['jourperiode_id'],
                    "anneeacademiq_id" => $temps['anneeacademiq_id'],
                    "libelle" => $temps['libelle'],
                    "type" => $temps['type'],
                    "date_debut" => $temps['date_debut'],
                    "date_fin" => $temps['date_fin'],
                    "enseignant_id" => $temps['enseignant_id']
                ]
            );

            array_push($array, $emploitemp);
        }
        //dd($array);
        return response()->json([
            'message' => 'insertion avec succes',
            'data'  => $array
        ]);
    }

    // modification de l'emploi de temps d'une journée
    public function update(Request $request, $id)
    {
        try {

            $array = array();
            foreach ($request->temp as $temps) {
                $emploitemp = EmploiTemp::Find($id);
                $emploitemp->update([

                    "sallebase_id" => $temps['sallebase_id'],
                    "matiere_id" => $temps['matiere_id'],
                    "salleclasse_id" => $temps['salleclasse_id'],
                    "jourperiode_id" => $temps['jourperiode_id'],
                    "anneeacademiq_id" => $temps['anneeacademiq_id'],
                    "libelle" => $temps['libelle'],
                    "type" => $temps['type'],
                    "date_debut" => $temps['date_debut'],
                    "date_fin" => $temps['date_fin'],
                    "enseignant_id" => $temps['enseignant_id']
                ]);

                array_push($array, $emploitemp);
            }

            return response()->json([
                'message' => 'modification avec succes',
                'data'  => $array
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
