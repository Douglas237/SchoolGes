<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\EvenementSportif;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvenementSportifRequest;
use App\Http\Requests\UpdateEvenementSportifRequest;
use App\Models\ComplexSportif;

class EvenementSportifController extends Controller
{
    // listing des evenement
    public function index()
    {
        try {
            $evenement = ComplexSportif::join('evenement_sportifs', 'complex_sportifs.id', '=', 'evenement_sportifs.complexsportif_id')->get();
            //   dd($evenement);
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'liste des evenements sportifs',
                'data' => $evenement
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //creation d'un evenement sportif

    public function store(StoreEvenementSportifRequest  $request)
    {

        try {

            $complexsportif = ComplexSportif::where('complex_sportifs.id', $request->complexsportif_id)->get();

            if ($complexsportif->isEmpty()) {
                return response()->json(["status_message" => "complex sportif non existant"]);
            }

            $evenementsportif = EvenementSportif::create($request->validated());
            // dd($complexsportif);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Evenement sportif a ete ajouté',
                'data' => $evenementsportif
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un evenement sportif
    public function update(UpdateEvenementSportifRequest $request, $id)
    {
        try {

            $complexsportif = ComplexSportif::where('complex_sportifs.id', $request->complexsportif_id)->get();

            if ($complexsportif->isEmpty()) {
                return response()->json(["message" => "le complex sportif n'existe pas"]);
            }
            $evenementsportif = EvenementSportif::Find($id);
            $evenementsportif->update($request->validated());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Evenement sportif a ete modifier',
                'data' => $evenementsportif
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer un evenement
    public  function destroy($id)
    {
        try {
            if ($id) {
                $evenement = EvenementSportif::find($id);
                $evenement->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Evenement supprimer',
                    'data' => $evenement
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Evenement introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un evenement
    public function show($id)
    {
        try {
            if ($id) {
                $evenement = EvenementSportif::find($id);
                return response()->json([
                    'status_message' => 'detail Evenement',
                    'data' => $evenement
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Evenement non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //evenement d'un complexe sportif
    public function evenement($id)
    {
        try {
            if ($id) {
                $evenement = EvenementSportif::where('evenement_sportifs.complexsportif_id', $id)->get();

                if ($evenement->isEmpty()) {
                    return response()->json(["status_message" => "Aucun evenement pour se complexe sportif"]);
                }
                return response()->json([
                    'status_message' => 'evenement pour se complexe sportif',
                    'data' => $evenement
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'evenement non existant'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
