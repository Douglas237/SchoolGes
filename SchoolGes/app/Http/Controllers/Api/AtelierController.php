<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Atelier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAtelierRequest;
use App\Http\Requests\UpdateAtelierRequest;
use App\Models\Etablissement;

class AtelierController extends Controller
{
    // liste des atelier
            public function index()
            {
                $atelier = Atelier::all();
                return response()->json([
                    'statut_code' => 200,
                    'statut_message' =>'liste des ateliers',
                    'data' => $atelier
                ]);
            }


          //creation d'un atelier

          public function store(StoreAtelierRequest  $request)
          {
              try{
                $etablissement = Etablissement::where('etablissements.id', $request->etablissement_id)->get();
                if($etablissement->isEmpty())
                {
                    return response()->json([
                        'status_message' => 'Aucun etablissement selectionner'
                    ]);
                }
                $atelier = Atelier::create($request->validated());

                  return response()->json([
                      'status_code' => 200,
                      'status_message' => 'Atelier ajouté',
                      'data' => $atelier
                  ]);
              }
              catch(Exception $e){
                  return response()->json($e);
              }
          }

          // modification d'un atelier
          public function update(UpdateAtelierRequest $request, $id)
          {
              try {
                $etablissement = Etablissement::where('etablissements.id', $request->etablissement_id)->get();
                if($etablissement->isEmpty())
                {
                    return response()->json([
                        'status_message' => 'Aucun etablissement selectionner'
                    ]);
                }
                  $atelier = Atelier::find($id);
                  $atelier->update($request->validated());

                  return response()->json([
                      'status_code' => 200,
                      'status_message' => 'Atelier modifier',
                      'data' => $atelier
                  ]);

              }
              catch(Exception $e) {
                  return response()->json([
                      'status_code' => 422,
                      'status_message' => 'erreur de modification'
                  ]);
              }

          }

          // supprimer un atelier
          public  function destroy($id)
          {
              try {
                  if($id) {
                      $atelier = Atelier::find($id);
                      $atelier->delete();

                      return response()->json([
                          'status_code' => 200,
                          'status_message' => 'Atelier supprimer',
                          'data' => $atelier
                      ]);
                  } else {
                      return response()->json([
                          'status_code' => 422,
                          'status_message' => 'Atelier introuvable'
                      ]);
                  }
              } catch(Exception $e) {
                  return response()->json($e);
              }
          }

          // afficher les informations d'un atelier
          public function show($id)
          {
              try {
                  if($id) {
                      $atelier = Atelier::find($id);
                      return response()->json([
                          'status_message' => 'detail atelier',
                          'data' => $atelier
                      ]);
                  } else {

                      return response()->json([
                          'status_code' => 422,
                      'status_message' => 'Atelier non existant'
                      ]);
                  }
              } catch(Exception $e) {
                  return response()->json($e);
              }


          }
}
