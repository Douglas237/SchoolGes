<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClubEleveRequest;
use App\Http\Requests\UpdateClubEleveRequest;
use App\Models\ClubEleve;

class ClubEleveController extends Controller
{
    // liste des club
    public function index()
    {
        try {
            $clubeleve = Etablissement::join('club_eleves', 'etablissements.id', '=', 'club_eleves.etablissement_id')->get();
            //   dd($evenement);
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'liste des clubs pour eleves',
                'data' => $clubeleve
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //creation d'un club

    public function store(StoreClubEleveRequest  $request)
    {

        try {

            $etablissement = Etablissement::where('etablissements.id', $request->etablissement_id)->get();

            if ($etablissement->isEmpty()) {
                return response()->json(["status_message" => "etablissement non existant"]);
            }

            $clubeleve = ClubEleve::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le club eleve a ete ajouté',
                'data' => $clubeleve
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un club
    public function update(UpdateClubEleveRequest $request, $id)
    {
        try {

            $etablissement = Etablissement::where('Etablissements.id', $request->etablissement_id)->get();

            if ($etablissement->isEmpty()) {
                return response()->json(["message" => "l'etablissement n'existe pas"]);
            }
            $clubeleve = ClubEleve::Find($id);
            $clubeleve->update($request->validated());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Club eleve a ete modifier',
                'data' => $clubeleve
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer un club eleve
    public  function destroy($id)
    {
        try {
            if ($id) {
                $clubeleve = ClubEleve::find($id);
                $clubeleve->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Club eleve supprimer',
                    'data' => $clubeleve
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

    // afficher les informations d'un club
    public function show($id)
    {
        try {
            if ($id) {
                $clubeleve = ClubEleve::find($id);
                return response()->json([
                    'status_message' => 'detail du club',
                    'data' => $clubeleve
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'club non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //club d'un etablissement
    public function clubeleve($id)
    {
        try {
            if ($id) {
                $clubeleve = ClubEleve::where('club_eleves.etablissement_id', $id)->get();

                if ($clubeleve->isEmpty()) {
                    return response()->json(["status_message" => "Aucun club pour cet etablissement"]);
                }
                return response()->json([
                    'status_message' => 'les club de cet etablissement',
                    'data' => $clubeleve
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'club non existant'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
