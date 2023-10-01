<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\BlocSalle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlocsalleRequest;
use App\Http\Requests\UpdateBlocsalleRequest;

class BlocSalleController extends Controller
{
    // listing des blocs de salle
    public function index()
    {
        try {
            $blocsalle = BlocSalle::all();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'liste des blocs de salle',
                'data' => $blocsalle
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //creation d'un bloc de salle

    public function store(StoreBlocsalleRequest $request)
    {
        try {

            $blocsalle = BlocSalle::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le bloc de salle a ete ajouté',
                'data' => $blocsalle
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un bloc de salle
    public function update(UpdateBlocsalleRequest $request, $id)
    {
        try {

            $blocsalle = BlocSalle::find($id);
            $blocsalle->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le bloc de salle a ete modifier',
                'data' => $blocsalle
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification du bloc',
            ]);
        }
    }

    // supprimer un bloc de salle existant
    public  function destroy($id)
    {
        try {
            if ($id) {
                $blocsalle = BlocSalle::find($id);
                $blocsalle->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'bloc de salle supprimer',
                    'data' => $blocsalle
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'bloc de salle introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un bloc de salle
    public function show($id)
    {
        try {
            if ($id) {
                $blocsalle = BlocSalle::find($id);
                return response()->json([
                    'status_message' => 'detail du blocsalle',
                    'data' => $blocsalle
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'bloc non existant du blocsalle'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
