<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatierClasseSystemRequest;
use App\Models\ClasseSystem;
use App\Models\MatiersysClassesys;
use Illuminate\Http\Request;

class MatiersysClassesysController extends Controller
{

    // liste des matieres d'une classe dans le system

    public function index()
    {
        $Matiereclasse = MatiersysClassesys::join('classe_systems', 'classe_systems.id', '=', 'matiersys_classesys.classesyst_id')
            ->join('matiere_systems', 'matiere_systems.id', '=', 'matiersys_classesys.matieresyst_id')
            ->get();
        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des matieres de la classe',
            'data' => $Matiereclasse
        ]);
    }

    // attachement des matieres a une classe

    public function store(StoreMatierClasseSystemRequest $request)
    {
        try {
            $class = ClasseSystem::findOrfail($request->classesyst_id);
            $class->matieresystems()->attach($request->matieresyst_id);


            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'classe et ses matieres',
                'data' => $class
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }


    // detacher une matiere a une classe

    public function detachermatiere(StoreMatierClasseSystemRequest $request, $id)
    {
        try {
            $Matiereclasse = MatiersysClassesys::Find($id);
            $class = ClasseSystem::findOrfail($request->classesyst_id);
            $class->matieresystems()->detach($Matiereclasse->matieresyst_id);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'detachement effectuer avec succes',
                'data' => $class
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json($e);
        }
    }

        // detaile d'une classe et ses periode

        public function show($id)
        {
            try {

                if ($id) {
                    $Matiereclasse = MatiersysClassesys::Find($id);
                    return response()->json([
                        'status_message' => 'detail de la classe et ses periodes',
                        'data' => $Matiereclasse
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 422,
                        'status_message' => 'choix non existant'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json($e);
            }
        }
}
