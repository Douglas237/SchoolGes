<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\AnneeAcademique;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnneeRequest;
use App\Http\Requests\UpdateAnneeRequest;

class AnneeAcademiqueController extends Controller
{
    //API de creation d'uune année académique dans le systeme

    //listing des années academiques du systeme
    public function index()
    {
        $annee = AnneeAcademique::all();
        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des annés academique du systeme',
            'data' => $annee
        ]);
    }

    // creation d'une année academique
    public function store(StoreAnneeRequest $request)
    {
        try {
            $annee = AnneeAcademique::create($request->validated());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'annee academique ajoutée',
                'data' => $annee
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'une année académique
    public function update(UpdateAnneeRequest $request, $id)
    {
        try {

            $annee = AnneeAcademique::Find($id);
            $annee->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'année académique modifier',
                'data' => $annee
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // Supprimer une annee academique
    public  function destroy($id)
    {
        try {
            if ($id) {
                $annee = AnneeAcademique::find($id);
                $annee->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'année académique supprimer',
                    'data' => $annee
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'année academique introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // affiché les details sur une année académique
    public function show($id)
    {
        try {
            if ($id) {
                $annee = AnneeAcademique::find($id);
                return response()->json([
                    'status_message' => 'detail année académique',
                    'data' => $annee
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'année académique non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
