<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\SalleBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PublicationEnseignant;
use App\Http\Requests\StorePublicEnseignantRequest;
use App\Http\Requests\UpdatePublicEnseignantRequest;

class PublicationEnseignantController extends Controller
{
          // liste des publications des enseignants
          public function index()
          {
              $pubenseignant = PublicationEnseignant::all();
              return response()->json([
                  'statut_code' => 200,
                  'statut_message' =>'liste des publications des enseignants',
                  'data' => $pubenseignant
              ]);
          }

        //creation d'une publication

        public function store(StorePublicEnseignantRequest $request)
        {
            try{

                $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();
                // dd($sallebase);


                if($sallebase->isEmpty())
                {
                    return response()->json(["status_message" => "salle de base non existante"]);
                }

                $pubenseignant = PublicationEnseignant::create($request->validated());

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Publication ajoutée',
                    'data' => $pubenseignant
                ]);
            }
            catch(Exception $e){
                return response()->json($e);
            }
        }

        // modification d'un publication
        public function update(UpdatePublicEnseignantRequest $request, $id)
        {
            try {

                $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();
                // dd($sallebase);

                if($sallebase->isEmpty())
                {
                    return response()->json(["status_message" => "salle de base non existante"]);
                }
                $pubenseignant = PublicationEnseignant::Find($id);
                // dd($fichepresencejour);
                $pubenseignant->update($request->validated());

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Publication modifier',
                    'data' => $pubenseignant
                ]);

            }
            catch(Exception $e) {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'erreur de modification'
                ]);
            }

        }

        // supprimer une publication
        public  function destroy($id)
        {
            try {
                if($id) {
                    $pubenseignant = PublicationEnseignant::find($id);
                    $pubenseignant->delete();

                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Publication supprimer',
                        'data' => $pubenseignant
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 422,
                        'status_message' => 'Publication introuvable'
                    ]);
                }
            } catch(Exception $e) {
                return response()->json($e);
            }
        }

        // afficher les informations d'une publication
        public function show($id)
        {
            try {
                if($id) {
                    $pubenseignant = PublicationEnseignant::find($id);
                    return response()->json([
                        'status_message' => 'detail publication',
                        'data' => $pubenseignant
                    ]);
                } else {

                    return response()->json([
                        'status_code' => 422,
                    'status_message' => 'Publication non existante'
                    ]);
                }
            } catch(Exception $e) {
                return response()->json($e);
            }

        }

        //afficher les publications d'une salle

        public function pubsalle($id)
        {
            try{
                if($id)
                {
                    $pubsalle = PublicationEnseignant::where('publication_enseignants.sallebase_id', $id)->get();
                    // dd($fichesalle);
                    if($pubsalle->isEmpty())
                    {
                        return response()->json(["status_message" => "Aucune publication trouvée pour cette salles"]);
                    }

                    return response()->json([
                        'status_message' => 'publication de la salle',
                        'data' => $pubsalle
                    ]);
                }else {
                    return response()->json([
                    'status_code' => 422,
                    'status_message' => 'publication non existante'
                    ]);
                }

            } catch(Exception $e)
            {
                return response()->json($e);
            }


        }
}
