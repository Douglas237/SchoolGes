<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\CahierTexte;
use Illuminate\Http\Request;
use App\Models\MatiereSystem;
use App\Models\programme_matiere;
use App\Http\Controllers\Controller;
use App\Models\Admincirconscription;
use App\Http\Requests\StoreProgrammeMatiereRequest;
use App\Http\Requests\CahiertextesProgrammematieresRequest;

class ProgrammeMatiereController extends Controller
{
    // liste des programme de matiere

    public function index()
    {

        $program = programme_matiere::all();
        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des programme matieres',
            'data' => $program
        ]);
    }

    // creation du programme de matiere

    public function store(StoreProgrammeMatiereRequest $request)
    {

        try {
            $admin = Admincirconscription::where('admincirconscriptions.id', $request->admincirconscription_id)->get();
            $matieresyst = MatiereSystem::where('matiere_systems.id', $request->matieresyst_id)->get();
            //dd($cycle);
            if ($admin->isEmpty() || $matieresyst->isEmpty()) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }

            $program = programme_matiere::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'programme ajouté',
                'data' => $program
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un programme matiere

    public function update(StoreProgrammeMatiereRequest $request, $id)
    {
        try {
            $admin = Admincirconscription::where('admincirconscriptions.id', $request->admincirconscription_id)->get();
            $matieresyst = MatiereSystem::where('matiere_systems.id', $request->matieresyst_id)->get();
            //dd($cycle);
            if ($admin->isEmpty() || $matieresyst->isEmpty()) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }
            $program = programme_matiere::Find($id);
            $program->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'programme modifier',
                'data' => $program
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer un programmme
    public  function destroy($id)
    {
        try {
            if ($id) {
                $program = programme_matiere::Find($id);
                $program->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'programme supprimer',
                    'data' => $program
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'programme introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un programme
    public function show($id)
    {
        try {
            if ($id) {
                $program = programme_matiere::Find($id);
                return response()->json([
                    'status_message' => 'detail du programme',
                    'data' => $program
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'programme non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }


    public function storeAssign(CahiertextesProgrammematieresRequest $request)
    {

        try {

            // dd($request);
            $cahiers = CahierTexte::FindOrFail($request->cahiertexte_id);
            $ProgrammeMatiere = programme_matiere::FindOrFail($request->prgMatiere_id);
            $ProgrammeMatiere->cahiersTextes()->attach($cahiers);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le Programme a ete assigner avec success!!!!!.',
                'data' => $ProgrammeMatiere,
            ]);
        } catch (\Exception $e) {

            return response()->json($e);

        }

    }





    public function storeDetach(CahiertextesProgrammematieresRequest $request)
    {

        try {
            $cahiers = CahierTexte::FindOrFail($request->cahiertexte_id);
            $ProgrammeMatiere = programme_matiere::FindOrFail($request->prgMatiere_id);
            $ProgrammeMatiere->cahiersTextes()->detach($cahiers);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $ProgrammeMatiere
            ]);
        } catch (\Exception $e) {

            return response()->json($e);
        }

    }
}
