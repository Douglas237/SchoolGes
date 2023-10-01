<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Eleve;
use App\Models\SalleBase;
use Illuminate\Http\Request;

use App\Models\FichePresenceJour;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFichePresenceJoursRequest;
use App\Http\Requests\UpdateFichePresenceJoursRequest;

class FichePresenceJoursController extends Controller
{
      // liste des fiches de presences par jours
      public function index()
      {
          $fiche = FichePresenceJour::all();
          return response()->json([
              'statut_code' => 200,
              'statut_message' =>'liste des fiches de presence',
              'data' => $fiche
          ]);
      }


    //creation d'une fiche de presence

    public function store(StoreFichePresenceJoursRequest $request)
    {
        try{

            $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();
            // dd($sallebase);
            $eleve = Eleve::where('eleves.id', $request->eleve_id)->get();
            // dd($eleve);

            if($sallebase->isEmpty() || $eleve->isEmpty())
            {
                return response()->json(["status_message" => "salle de base ou eleve non existante"]);
            }

            $fichepresencejour = FichePresenceJour::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'fiche de presnece ajouté',
                'data' => $fichepresencejour
            ]);
        }
        catch(Exception $e){
            return response()->json($e);
        }
    }

    // modification d'une fiche de presence
    public function update(UpdateFichePresenceJoursRequest $request, $id)
    {
        try {

            $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();
            // dd($sallebase);
            $eleve = Eleve::where('eleves.id', $request->eleve_id)->get();

            if($sallebase->isEmpty() || $eleve->isEmpty())
            {
                return response()->json(["status_message" => "salle de base ou eleve non existante"]);
            }
            $fichepresencejour = FichePresenceJour::Find($id);
            // dd($fichepresencejour);
            $fichepresencejour->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'fiche de presence modifier',
                'data' => $fichepresencejour
            ]);

        }
        catch(Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }

    }

    // supprimer une fiche de presence
    public  function destroy($id)
    {
        try {
            if($id) {
                $fiche = FichePresenceJour::find($id);
                $fiche->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'fiche de presence supprimer',
                    'data' => $fiche
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'fiche introuvable'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'une fiche de presence
    public function show($id)
    {
        try {
            if($id) {
                $fiche = FichePresenceJour::find($id);
                return response()->json([
                    'status_message' => 'detail fiche de la fiche',
                    'data' => $fiche
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                'status_message' => 'fiche non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }


    }

    //afficher les fiches de presences d'une salle

    public function fichesalle($id)
    {
        try{
            if($id)
            {
                $fichesalle = FichePresenceJour::where('fiche_presence_jours.sallebase_id', $id)->get();
                // dd($fichesalle);
                if($fichesalle->isEmpty())
                {
                    return response()->json(["status_message" => "Aucune fiche trouver pour cette salles"]);
                }

                return response()->json([
                    'status_message' => 'fiche de la salle',
                    'data' => $fichesalle
                ]);
            }else {
                return response()->json([
                'status_code' => 422,
                'status_message' => 'fiche non existant'
                ]);
            }

        } catch(Exception $e)
        {
            return response()->json($e);
        }


    }
}
