<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\SalleBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalleBaseRequest;
use App\Http\Requests\UpdateSalleBaseRequest;
use App\Models\Classe;
use App\Models\Etablissement;
use App\Models\Fourniture;

//*********************************************** */
// ici sallebase correspond à la table salle du MCD
//*********************************************** */

class SalleBaseController extends Controller
{
    // listing des salles
    public function index()
    {
        try {
            $salle = SalleBase::all();
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'liste des salles',
                'data' => $salle
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //creation d'une salle

    public function store(StoreSalleBaseRequest $request)
    {
        try {

            $etablissement = Etablissement::all();

            if ($etablissement->isEmpty()) {
                return response()->json(["status_message" => "informations sur un etablissement"]);
            }
            $salle = SalleBase::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la salle a ete ajouté',
                'data' => $salle
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'une salle
    public function update(UpdateSalleBaseRequest $request, $id)
    {
        try {
            $etablissement = Etablissement::all();

            if ($etablissement->isEmpty()) {
                return response()->json(["status_message" => "informations manquantes veuillez verifier vous champs"]);
            }

            $salle = SalleBase::Find($id);
            $salle->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la salle a ete modifier',
                'data' => $salle
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification de la salle',
            ]);
        }
    }

    // supprimer une salle existante
    public  function destroy($id)
    {
        try {
            if ($id) {
                $salle = SalleBase::find($id);
                $salle->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'salle supprimer',
                    'data' => $salle
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'salle introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'une salle
    public function show($id)
    {
        try {
            if ($id) {
                $salle = SalleBase::find($id);
                return response()->json([
                    'status_message' => 'detail du blocsalle',
                    'data' => $salle
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'salle non existante'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les salle d'un etablissement

    public function sallesetablis($id)
    {
        try{
            if($id)
            {
                $salle = SalleBase::where('salle_bases.etablissement_id', $id)->get();

                if($salle->isEmpty())
                {
                    return response()->json(["status_message" => "Aucune salle de classe pour cet etablissement"]);
                }

                return response()->json([
                    'status_message' => 'salle pour cet etablissement',
                    'data' => $salle
                ]);
            }else {
                return response()->json([
                'status_code' => 422,
                'status_message' => 'salle non existante'
                ]);
            }

        } catch(Exception $e)
        {
            return response()->json($e);
        }

    }
}
