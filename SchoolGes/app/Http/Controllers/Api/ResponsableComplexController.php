<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Fonction;
use App\Models\Enseignant;
use Illuminate\Http\Request;
use App\Models\ComplexSportif;
use App\Models\ResponsableComplex;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResponsableComplexRequest;
use App\Http\Requests\UpdateResponsableComplexRequest;

class ResponsableComplexController extends Controller
{
       // liste des responsables de complexe

       public function index()
       {
           $responsable = ResponsableComplex::join('complex_sportifs', 'complex_sportifs.id','=', 'responsable_complexes.complexsportif_id')
           ->join('fonctions','fonctions.id','=','responsable_complexes.fonction_id')
           ->join('enseignants','enseignants.id','=','responsable_complexes.enseignant_id')
           ->get();
           return response()->json([
               'statut_code' => 200,
               'statut_message' => 'liste des responsables de complex sportifs',
               'data' => $responsable
           ]);
       }

       // creation d'un responsable

       public function store(StoreResponsableComplexRequest $request)
       {
           try {
               $complexsportif = ComplexSportif::where('Complex_sportifs.id', $request->complexsportif_id)->get();
               $fonction = Fonction::where('fonctions.id', $request->fonction_id)->get();
               $enseignant = Enseignant::where('enseignants.id', $request->enseignant_id)->get();
               if ($complexsportif->isEmpty() || $fonction->isEmpty() || $enseignant->isEmpty()) {
                   return response()->json([
                       'status_message' => 'veuillez entrer tous vos champs'
                   ]);
               }

               $responsable = ResponsableComplex::create($request->validated());

               return response()->json([
                   'status_code' => 200,
                   'status_message' => 'responsable ajouté',
                   'data' => $responsable
               ]);
           } catch (\Exception $e) {
               return response()->json($e);
           }
       }

       // modification d'un responsable de complex

       public function update(UpdateResponsableComplexRequest $request, $id)
       {
           try {
            $complexsportif = ComplexSportif::where('Complex_sportifs.id', $request->complexsportif_id)->get();
            $fonction = Fonction::where('fonctions.id', $request->fonction_id)->get();
            $enseignant = Enseignant::where('enseignants.id', $request->enseignant_id)->get();
            if ($complexsportif->isEmpty() || $fonction->isEmpty() || $enseignant->isEmpty()) {
                return response()->json([
                    'status_message' => 'veuillez entrer tous vos champs'
                ]);
            }
               $responsable = ResponsableComplex::Find($id);
               $responsable->update($request->validated());

               return response()->json([
                   'status_code' => 200,
                   'status_message' => 'responsable modifier',
                   'data' => $responsable
               ]);
           } catch (\Exception $e) {
               return response()->json([
                   'status_code' => 422,
                   'status_message' => 'erreur de modification'
               ]);
           }
       }

       // supprimer un responsable
       public  function destroy($id)
       {
           try {
               if ($id) {
                   $responsable = ResponsableComplex::find($id);
                   $responsable->delete();

                   return response()->json([
                       'status_code' => 200,
                       'status_message' => 'responsable supprimer',
                       'data' => $responsable
                   ]);
               } else {
                   return response()->json([
                       'status_code' => 422,
                       'status_message' => 'responsable introuvable'
                   ]);
               }
           } catch (Exception $e) {
               return response()->json($e);
           }
       }

       // afficher les informations d'un responsable
       public function show($id)
       {
           try {
               if ($id) {
                   $responsable = ResponsableComplex::find($id);
                   return response()->json([
                       'status_message' => 'detail du responsable',
                       'data' => $responsable
                   ]);
               } else {

                   return response()->json([
                       'status_code' => 422,
                       'status_message' => 'responsable non existant'
                   ]);
               }
           } catch (Exception $e) {
               return response()->json($e);
           }
       }
}
