<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\CycleEnseignement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCycleEnseignementRequest;
use App\Http\Requests\UpdateCycleEnseignementRequest;

class CycleEnseignementController extends Controller
{
    // listing des cycles d'enseignement
    public function index()
    {
        try {
            $cycle = CycleEnseignement::all();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'liste des cycles enseignements',
                'data' => $cycle
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //creation d'un cycle d'enseignement

    public function store(StoreCycleEnseignementRequest $request)
    {
        try {

            $cycle = CycleEnseignement::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le cycle a ete ajouté',
                'data' => $cycle
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

        // modification d'un cycle d'enseignement
        public function update(UpdateCycleEnseignementRequest $request, $id)
        {
            try {

                $cycle = CycleEnseignement::find($id);
                $cycle->update($request->validated());

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'le cycle a ete modifier',
                    'data' => $cycle
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'erreur de modification du bloc',
                ]);
            }
        }

           // supprimer un cycle d'enseignement
    public  function destroy($id)
    {
        try {
            if ($id) {
                $cycle = CycleEnseignement::find($id);
                $cycle->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'cycle enseignement supprimer',
                    'data' => $cycle
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'cycle enseignement introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

        // afficher les informations d'un cycle d'enseignement
        public function show($id)
        {
            try {
                if ($id) {
                    $cycle = CycleEnseignement::find($id);
                    return response()->json([
                        'status_message' => 'detail du cycle enseignement',
                        'data' => $cycle
                    ]);
                } else {

                    return response()->json([
                        'status_code' => 422,
                        'status_message' => 'cycle non existant'
                    ]);
                }
            } catch (Exception $e) {
                return response()->json($e);
            }
        }
}
