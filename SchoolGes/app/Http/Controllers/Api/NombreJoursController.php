<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\NombreJours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNombreJoursRequest;
use App\Http\Requests\UpdateNombreJoursRequest;
use App\Models\Periode;

class NombreJoursController extends Controller
{
    // liste des nombres de jours d'un établissement
    public function index ()
    {
        try {

            $jour = NombreJours::all();

            return response()->json([
                'statut_code' => "200",
                'statut_text' => "liste des jours",
                'data' => $jour
            ]);

        } catch (\Exception $e) {

            return response()->json($e);
        }

    }

    // creation d'un jours à la liste
    public function store(StoreNombreJoursRequest $request)
    {
        try {

            $jour = NombreJours::create($request->validated());

            return response()->json([
                'statut_code' => 200,
                'statut_text' => 'Jours ajouter',
                'data' => $jour
            ]);

        } catch (\Exception $e)
        {
            return response()->json($e);
        }
    }

    // modification d'un jours

    public function update(UpdateNombreJoursRequest $request,$id)
    {
        try {
            $jours = NombreJours::find($id);
            $jours->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'jours modifier',
                'data' => $jours
            ]);
        } catch (\Exception $e)
        {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

        // suppression d'un jour

        public  function destroy($id)
        {
            try {
                if($id) {
                    $jours = NombreJours::find($id);
                    $jours->delete();

                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Jours supprimer',
                        'data' => $jours
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 422,
                        'status_message' => 'jour introuvable'
                    ]);
                }
            } catch(Exception $e) {
                return response()->json($e);
            }
        }

            // afficher les informations d'un jour
    public function show($id)
    {
        try {
            if($id) {
                $jours = NombreJours::find($id);
                return response()->json([
                    'status_message' => 'detail du jours',
                    'data' => $jours
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                'status_message' => 'jour non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }

    }
}
