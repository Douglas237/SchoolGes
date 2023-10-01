<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Atelier;
use App\Models\Fonction;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\ResponsableAtelier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResponAtelierRequest;
use App\Http\Requests\UpdateResponAtelierRequest;

class ResponsableAtelierController extends Controller
{
    // liste des responsables d'atelier

    public function index()
    {
        $responsable = ResponsableAtelier::join('ateliers', 'ateliers.id', '=', 'responsable_ateliers.atelier_id')
        ->join('fonctions','fonctions.id','=','responsable_ateliers.fonction_id')
        ->join('enseignants','enseignants.id','=','responsable_ateliers.enseignant_id')
        ->get();
        // $responsable = ResponsableAtelier::all();
        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des responsables ateliers',
            'data' => $responsable
        ]);
    }

    // creation d'un responsable d'atelier

    public function store(StoreResponAtelierRequest $request)
    {
        try {
            $atelier = Atelier::where('ateliers.id', $request->atelier_id)->get();
            $fonction = Fonction::where('fonctions.id', $request->fonction_id)->get();
            $enseignant = Enseignant::where('enseignants.id', $request->enseignant_id)->get();
            if ($atelier->isEmpty() || $fonction->isEmpty() || $enseignant->isEmpty()) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }

            $responsable = ResponsableAtelier::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'responsable ajouté',
                'data' => $responsable
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un responsable d'atelier

    public function update(UpdateResponAtelierRequest $request, $id)
    {
        try {
            $atelier = Atelier::where('ateliers.id', $request->atelier_id)->get();
            $fonction = Fonction::where('fonctions.id', $request->fonction_id)->get();
            $enseignant = Enseignant::where('enseignants.id', $request->enseignant_id)->get();
            if ($atelier->isEmpty() || $fonction->isEmpty() || $enseignant->isEmpty()) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }
            $responsable = ResponsableAtelier::Find($id);
            $responsable->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'responsable modifier',
                'data' => $responsable
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer un responsable
    public  function destroy($id)
    {
        try {
            if ($id) {
                $responsable = ResponsableAtelier::find($id);
                $responsable->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'responsable supprimer',
                    'data' => $responsable
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'responsable introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un responsable
    public function show($id)
    {
        try {
            if ($id) {
                $responsable = ResponsableAtelier::find($id);
                return response()->json([
                    'status_message' => 'detail du responsable',
                    'data' => $responsable
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'responsable non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
