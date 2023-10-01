<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Models\NiveauEnseignement;
use App\Http\Controllers\Controller;
use App\Models\EtablissementNiveauenseig;
use App\Http\Requests\UpdateNiveauEnseigRequest;
use App\Http\Requests\StoreEtablissemtNiveauRequest;
use App\Http\Requests\UpdateEtablissemtNiveauRequest;

class EtablissementNiveauController extends Controller
{
    // liste des etablissements et leur niveaux d'enseignement

    public function index()
    {
        try {
            $etablissement = EtablissementNiveauenseig::all();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'liste des etablissements et leur niveaux',
                'data' => $etablissement
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // liée un etablissement à son niveau d'enseignement
    public function createatache()
    {
        try {
            $etablissement = Etablissement::all();
            $niveauenseign = NiveauEnseignement::all();
            $etablissement->niveauenseigs()->attach($niveauenseign);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le niveau a ete liee a un etablissement',
                'data' => $niveauenseign
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    //creer une modification pour le niveau d'enseignement d'un etablissement

    public function store(StoreEtablissemtNiveauRequest $request)
    {
        try {
            $etablissement = Etablissement::where('etablissements.id', $request->etablissement_id)->get();
            $niveauenseign = NiveauEnseignement::where('niveau-enseignements.id', $request->niveauenseignement_id)->get();
            if($etablissement->isEmpty() || $niveauenseign->isEmpty())
            {
                return response()->json([
                    'status_message' => 'etablissement ou niveau non selectionner'
                ]);
            }

            $etablissementniveau = EtablissementNiveauenseig::create($request->validated());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Niveau etablissement ajouté',
                'data' => $etablissementniveau
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    //mofification du niveau d'enseignement d'un établissement
    public function update(UpdateEtablissemtNiveauRequest $request, $id)
    {
        try {
            $etablissement = Etablissement::where('etablissements.id', $request->etablissement_id)->get();
            $niveauenseign = NiveauEnseignement::where('niveau_enseignements.id', $request->niveauenseignement_id)->get();
            if($etablissement->isEmpty() || $niveauenseign->isEmpty())
            {
                return response()->json([
                    'status_message' => 'etablissement ou niveau non selectionner'
                ]);
            }

            $etablissementniveau = EtablissementNiveauenseig::Find($id);
            $etablissementniveau->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Niveau etablissement modifiée',
                'data' => $etablissementniveau
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // afficher les informations d'un etablissement et son niveau
    public function show($id)
    {
        try {
            if($id) {
                $etablissementniveau = EtablissementNiveauenseig::find($id);
                return response()->json([
                    'status_message' => 'detail du niveau et etablissement',
                    'data' => $etablissementniveau
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                'status_message' => 'non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }
    }

    // supprimer un niveau d'enseignement d'un etablissement
    public  function destroy($id)
    {
        try {
            if($id) {
                $etablissementniveau = EtablissementNiveauenseig::find($id);
                $etablissementniveau->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'niveau etablissement supprimer',
                    'data' => $etablissementniveau
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'niveau etablissement introuvable'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }
    }
}
