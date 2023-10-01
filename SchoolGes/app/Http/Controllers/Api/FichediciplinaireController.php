<?php

namespace App\Http\Controllers\Api;

use App\Models\Fichediciplinaire;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFichediciplinaireRequest;
use App\Http\Requests\UpdateFichediciplinaireRequest;
use App\Http\Resources\FichediciplinaireResource;
use App\Models\Eleve;

class FichediciplinaireController extends Controller
{
    /**
     * Ajouter une fiche disciplinaire a un eleve.
     */
    public function addfiche(StoreFichediciplinaireRequest $request)
    {
        //
        $verif = Eleve::find($request->eleve_id);
        if (!$verif) {
            # code...
            return response()->json([
              'message' => 'eleve non trouvé'
            ]);
        }
        $fichediciplinaire = Fichediciplinaire::create($request->validated());
        $result = FichediciplinaireResource::make($fichediciplinaire);

        return response()->json(["message" =>"fiche ajouter avec success",
        "data"=>$result]);
    }

    /**
     * Afficher les fiches disciplinaire d'un eleve.
     */
    public function showfiche($id)
    {
        $allfiches = Fichediciplinaire::where('fichediciplinaires.eleve_id', $id)->get();
        if ($allfiches->isEmpty()) {
            # code...
            return response()->json([
             'message' => "cet eleve n'as pas de fiche disciplinaire",
            ]);
        }
        $result = FichediciplinaireResource::collection($allfiches);
        return response()->json(["message" =>"fiches trouvées avec success",
        "data"=>$result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatefiche(UpdateFichediciplinaireRequest $request, Fichediciplinaire $fichediciplinaire)
    {
        //
        $request->validated();
        $verif = Eleve::where('eleves.id', $request->eleve_id)->get();
        if ($verif->isEmpty()) {
            # code...
            return response()->json(["message"=>"eleve entrer inexistant"]);
        }

        $fichediciplinaire->update($request->validated());

        return FichediciplinaireResource::make($fichediciplinaire);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyfiche($id)
    {
        //
        // verifie l'existance avant suppression
        $del = Fichediciplinaire::find($id);
        if (!$del) {
            # code...
            return response()->json(["message"=>"la fiche disciplinaire n'existe pas"]);
        }
        // suppression
        $del->delete();
        return response()->json([
            "message"=>"succes",
            "data"=>$del,
        ]);
    }
}
