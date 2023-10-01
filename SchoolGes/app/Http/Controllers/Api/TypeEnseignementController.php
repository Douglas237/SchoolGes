<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\TypeEnseignement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeEnseignementRequest;
use App\Http\Requests\UpdateTypeEnseignementRequest;

class TypeEnseignementController extends Controller
{
    // listing des types d'enseignement
    public function index()
    {
        try {
            $type = TypeEnseignement::all();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'liste des types enseignements',
                'data' => $type
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //creation d'un type d'enseignement

    public function store(StoreTypeEnseignementRequest $request)
    {
        try {

            $type = TypeEnseignement::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le type a ete ajouté',
                'data' => $type
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un type d'enseignement
    public function update(UpdateTypeEnseignementRequest $request, $id)
    {
        try {

            $type = TypeEnseignement::find($id);
            $type->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le type a ete modifier',
                'data' => $type
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification du bloc',
            ]);
        }
    }

    // supprimer un type d'enseignement
    public  function destroy($id)
    {
        try {
            if ($id) {
                $type = TypeEnseignement::find($id);
                $type->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'type enseignement supprimer',
                    'data' => $type
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'type enseignement introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un type d'enseignement
    public function show($id)
    {
        try {
            if ($id) {
                $type = TypeEnseignement::find($id);
                return response()->json([
                    'status_message' => 'detail du type enseignement',
                    'data' => $type
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'type non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
