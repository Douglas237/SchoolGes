<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\MatiereSystem;
use App\Models\TypeEnseignement;
use App\Models\CycleEnseignement;
use App\Models\NiveauEnseignement;
use App\Http\Controllers\Controller;
use App\Models\Admincirconscription;
use App\Http\Requests\StoreMatiereSystemRequest;
use App\Http\Requests\UpdateMatiereSystemRequest;

class MatiereSystemController extends Controller
{
    // liste des matieres du systeme

    public function index()
    {
        // $matieresyst = MatiereSystem::all();
        $matieresyst = MatiereSystem::join('type_enseignements', 'type_enseignements.id', '=', 'matiere_systems.typeenseignemt_id')
            ->join('niveau_enseignements', 'niveau_enseignements.id', '=', 'matiere_systems.niveauenseignemt_id')
            ->join('cycle_enseignements', 'cycle_enseignements.id', '=', 'matiere_systems.cycleenseignemt_id')
            ->get([
                "matiere_systems.*","cycle_enseignements.intituler as intituller_cycleenseignements","niveau_enseignements.intitule_niveau","type_enseignements.intituler as intituller_type_enseignements"
            ]);



        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des matieres du systeme',
            'data' => $matieresyst
        ]);
    }

    // creation d'une matiere du systeme

    public function store(StoreMatiereSystemRequest $request)
    {

        try {
            $admin = Admincirconscription::where('admincirconscriptions.id', $request->admincirconscription_id)->get();
            $type = TypeEnseignement::where('type_enseignements.id', $request->typeenseignemt_id)->get();
            $niveau = NiveauEnseignement::where('niveau_enseignements.id', $request->niveauenseignemt_id)->get();
            $cycle = CycleEnseignement::where('cycle_enseignements.id', $request->cycleenseignemt_id)->get();
            //dd($cycle);
            if ($admin->isEmpty() || $type->isEmpty() || $niveau->isEmpty() || $cycle->isEmpty() ) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }

            $matieresyst = MatiereSystem::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'matiere ajouté',
                'data' => $matieresyst
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'une matiere

    public function update(UpdateMatiereSystemRequest $request, $id)
    {
        try {
            $admin = Admincirconscription::where('admincirconscriptions.id', $request->admincirconscription_id)->get();
            $type = TypeEnseignement::where('type_enseignements.id', $request->typeenseignemt_id)->get();
            $niveau = NiveauEnseignement::where('niveau_enseignements.id', $request->niveauenseignemt_id)->get();
            $cycle = CycleEnseignement::where('cycle_enseignements.id', $request->cycleenseignemt_id)->get();
            if ($admin->isEmpty() || $type->isEmpty() || $niveau->isEmpty() || $cycle->isEmpty()) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }
            $matieresyst = MatiereSystem::Find($id);
            $matieresyst->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'cette matiere a ete modifier',
                'data' => $matieresyst
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer une matiere
    public  function destroy($id)
    {
        try {
            if ($id) {
                $matieresyst = MatiereSystem::find($id);
                $matieresyst->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'matiere supprimer',
                    'data' => $matieresyst
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'matiere introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'une matiere
    public function show($id)
    {
        try {
            if ($id) {
                $matieresyst = MatiereSystem::find($id);
                return response()->json([
                    'status_message' => 'detail de la matiere',
                    'data' => $matieresyst
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'matiere non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
