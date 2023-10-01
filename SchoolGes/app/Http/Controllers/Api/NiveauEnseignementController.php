<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\NiveauEnseignement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNiveauEnseigRequest;
use App\Http\Requests\UpdateNiveauEnseigRequest;

class NiveauEnseignementController extends Controller
{
    // liste des niveaux d'enseignement
    public function index()
    {
        try {
            $niveau = NiveauEnseignement::all();
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'liste des niveaux enseignement',
                'data' => $niveau
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // creation d'un niveau d'enseignement

    public function store(StoreNiveauEnseigRequest $request)
    {
        try {
            $niveau = NiveauEnseignement::create($request->validated());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'niveau ajouté',
                'data' => $niveau
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un niveau d'enseignement

    public function update(UpdateNiveauEnseigRequest $request, $id)
    {
        try {

            $niveau = NiveauEnseignement::Find($id);
            $niveau->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'niveau enseignement modifier',
                'data' => $niveau
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer un niveau d'enseignement

    public  function destroy($id)
    {
        try {
            if ($id) {
                $niveau = NiveauEnseignement::find($id);
                $niveau->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'niveau enseignement supprimer',
                    'data' => $niveau
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'niveau introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

        // afficher les informations d'un niveau d'enseignement
        public function show($id)
        {
            try {
                if($id) {
                    $niveau = NiveauEnseignement::find($id);
                    return response()->json([
                        'status_message' => 'detail du niveau',
                        'data' => $niveau
                    ]);
                } else {

                    return response()->json([
                        'status_code' => 422,
                    'status_message' => 'niveau non existant'
                    ]);
                }
            } catch(Exception $e) {
                return response()->json($e);
            }

        }
}
