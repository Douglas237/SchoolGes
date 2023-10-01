<?php

namespace App\Http\Controllers\Api;

use App\Models\Matiere;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatiereRequest;
use App\Http\Requests\UpdateMatiereRequest;
use App\Http\Resources\MatiereResource;
use App\Models\Classe;
use App\Models\MatiereSystem;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matieres = Matiere::all();
        return MatiereResource::collection($matieres);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addMatiere(StoreMatiereRequest $request)
    {
        //
        $classe = Classe::find($request->classe_id);
        $matieresyst = MatiereSystem::find($request->matieresyst_id);
        if (!$classe || !$matieresyst) {
            # code...
            return response()->json([
              'message' => 'La classe ou la matiere n\'existe pas'
            ], 404);
        }
        $matiere = Matiere::create($request->validated());

        return response()->json([
            'message' => 'matiere enregistrer avec succes',
            'data' => $matiere,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showMatiere($id)
    {
        //
        $allmatieres = Matiere::where('matieres.classe_id', $id)->get();
        if ($allmatieres->isEmpty()) {
            # code...
            return response()->json([
             'message' => "cette classe n'as pas de matiere",
            ]);
        }
        $result = MatiereResource::collection($allmatieres);
        return response()->json(["message" =>"matieres trouvées avec success",
        "data"=>$result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateMatiere(UpdateMatiereRequest $request, Matiere $matiere)
    {
        //
        $request->validated();
        $verif = Classe::where('classes.id', $request->classe_id)->get();
        $matieresyst = MatiereSystem::where('matiere_systems.id', $request->matieresyst_id)->get();
        if ($verif->isEmpty() || $matieresyst->isEmpty()) {
            # code...
            return response()->json(["message"=>"classe ou matiere du system entrer inexistant"]);
        }

        $matiere->update($request->validated());

        return MatiereResource::make($matiere);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteMatiere($id)
    {
        $del = Matiere::find($id);
        if (!$del) {
            # code...
            return response()->json(["message"=>"la matiere n'existe pas"]);
        }
        // suppression
        $del->delete();
        return response()->json([
            "message"=>"succes",
            "data"=>$del,
        ]);

    }
}
