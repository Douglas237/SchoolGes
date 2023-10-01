<?php

namespace App\Http\Controllers\Api;

use App\Models\Eleve;
use App\Models\Classe;
use Illuminate\Support\Str;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;
use App\Models\Eleves_etablissement;
use App\Http\Resources\EleveResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEleveRequest;
use App\Http\Requests\UpdateEleveRequest;
use App\Models\SalleClasse;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showStudent($id)
    {
        $unic_etablissement = Eleves_etablissement::where('etablissement_id', $id)->get();

        if ($unic_etablissement->isEmpty()) {
            # code...
            return response()->json(['message' => "cet etablissement n'a pas d'eleve"], 404);
        }
        // jointures des $cantines_produits et produits pour avoir les produits d'une cantine donner
        $eleves = Eleves_etablissement::join('etablissements', 'eleves_etablissements.etablissement_id', '=', 'etablissements.id')
            ->where('etablissement_id', $id)
            ->join('eleves', 'eleves_etablissements.eleve_id', '=', 'eleves.id')
            ->get();
        // dd($produits);
        if ($eleves->isEmpty()) {
            # code...
            return response()->json(['message' => "donner introuvable car l'etablissement ou l'eleve n'existe"]);
        }

        return EleveResource::collection($eleves);
    }

    // ajouter un eleve a un etablissement donner
    public function addStudent(StoreEleveRequest $request, $etablissement)
    {
        $unic_etablissement = Etablissement::find($etablissement);
        // $salleclasse = SalleClasse::find($request->input('salleclasse_id'));

        // if ($salleclasse->eleves->count() >= $salleclasse->capacity) {
        //     $nextsalleclasse = SalleClasse::where('capacity', '>', 'students_count')
        //         ->orderBy('id')
        //         ->first();

        //     if ($nextsalleclasse) {
        //         $salleclasse = $nextsalleclasse;
        //     } else {
        //         return response()->json([
        //             'message' => 'All salleclasses are full.'
        //         ], 400);
        //     }
        // }

        if (!$unic_etablissement) {
            # code...
            return response()->json([
                'message' => 'Etablissement non trouvé'
            ]);
        }
        $imageName = $request->nom . "." . $request->photo->getClientOriginalExtension();

        $new_eleve = Eleve::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'genre' => $request->genre,
            'photo' => $imageName,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'region_origine' => $request->region_origine,
            'lieu_origine' => $request->lieu_origine,
            'parent_id' => $request->parent_id,
            'salleclasse_id' => $request->salleclasse_id,
            'classe_id' => $request->classe_id,
        ]);
        //ave image in storage folder
        Storage::disk('public')->put($imageName, file_get_contents($request->photo));


        $unic_etablissement->eleves()->attach($new_eleve);
        return response()->json([
            'message' => 'Eleve ajouté avec succès',
            'data' => $new_eleve
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateStudent(UpdateEleveRequest $request, Etablissement $etablissement, Eleve $eleve)
    {
        //
        $unic_eleve = Eleves_etablissement::join('etablissements', 'eleves_etablissements.etablissement_id', '=', 'etablissements.id')
            ->where('etablissement_id', $etablissement->id)
            ->join('eleves', 'eleves_etablissements.eleve_id', '=', 'eleves.id')
            ->where('eleves.id', $eleve->id)
            ->get();
            $classe = Classe::where('classes.id', $request->classe_id)->get();
            $salleClasse = SalleClasse::where('salles_classes.id', $request->salleClasse_id)->get();
            if(!$classe || !$salleClasse || !$unic_eleve)
            {
                return response()->json([
                    'status_message' => 'classe ou salle de classe non selectionner ainsi que eleve'
                ]);
            }

        // on veriffie si le produit a update est parmis les produit de la cantine en question
        // if ($unic_eleve->isEmpty()) {
        //     # code...
        //     return response()->json(['message' => "cet eleve n'apartien pas a cet etablissement"]);
        // }

        $eleve->nom = $request->nom;
        $eleve->prenom = $request->prenom;
        $eleve->genre = $request->genre;
        $eleve->photo = $request->photo;
        $eleve->telephone = $request->telephone;
        $eleve->date_naissance = $request->date_naissance;
        $eleve->lieu_naissance = $request->lieu_naissance;
        $eleve->region_origine = $request->region_origine;
        $eleve->lieu_origine = $request->lieu_origine;
        $eleve->parent_id = $request->parent_id;
        $eleve->salleclasse_id = $request->salleclasse_id;
        $eleve->classe_id = $request->classe_id;
        if ($request->photo) {
            //pulbic storage
            $storage = Storage::disk('public');
            //old photo delete
            if ($storage->exists($eleve->photo))
                $storage->delete($eleve->photo);

            //Image Name
            $imageName = $request->nom . "." . $request->photo->getClientOriginalExtension();
            $eleve->photo = $imageName;
            //Image save in public folder

            $storage->put($imageName, file_get_contents($request->photo));
        }

        $eleve->update();

        return EleveResource::make($eleve);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function removeUniqueStudent(Etablissement $etablissement, Eleve $eleve,)
    {
        //
        $unic_eleve = Eleves_etablissement::join('etablissements', 'eleves_etablissements.etablissement_id', '=', 'etablissements.id')
            ->where('etablissement_id', $etablissement->id)
            ->join('eleves', 'eleves_etablissements.eleve_id', '=', 'eleves.id')
            ->where('eleves.id', $eleve->id)
            ->get();
        // on veriffie si le produit a update est parmis les produit de la cantine en question
        if ($unic_eleve->isEmpty()) {
            # code...
            return response()->json(['message' => "cet eleve n'apartien pas a cet etablissement"]);
        }

        $etablissement->eleves()->detach($eleve);

        return EleveResource::make($eleve);
    }



}
