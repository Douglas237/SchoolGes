<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Tranche;
use App\Models\Moratoire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMoratoireRequest;
use App\Http\Requests\UpdateMoratoireRequest;

class MoratoireController extends Controller
{
       // liste des moratoires
       public function index()
       {
           $moratoires = Moratoire::all();
           return response()->json([
               'statut_code' => 200,
               'statut_message' =>'liste des moratoires',
               'data' => $moratoires
           ]);
       }


     //creation d'un moratoire

     public function store(StoreMoratoireRequest $request)
     {
         try{

             $tranche = Tranche::where('tranches.id', $request->tranche_id)->get();
             // dd($tranche);

             if($tranche->isEmpty())
             {
                 return response()->json(["status_message" => "cette tranche n'existe pas"]);
             }

             $moratoire = Moratoire::create($request->validated());

             return response()->json([
                 'status_code' => 200,
                 'status_message' => 'Moratoire ajouté',
                 'data' => $moratoire
             ]);
         }
         catch(Exception $e){
             return response()->json($e);
         }
     }

     // modification d'un moratoire
     public function update(UpdateMoratoireRequest $request, $id)
     {
         try {

            $tranche = Tranche::where('tranches.id', $request->tranche_id)->get();
            // dd($tranche);

            if($tranche->isEmpty())
            {
                return response()->json(["status_message" => "cette tranche n'existe pas"]);
            }
             $moratoire = Moratoire::Find($id);

             $moratoire->update($request->validated());

             return response()->json([
                 'status_code' => 200,
                 'status_message' => 'moratoire modifier',
                 'data' => $moratoire
             ]);

         }
         catch(Exception $e) {
             return response()->json([
                 'status_code' => 422,
                 'status_message' => 'erreur de modification'
             ]);
         }

     }

     // supprimer un moratoire
     public  function destroy($id)
     {
         try {
             if($id) {
                 $moratoire = Moratoire::find($id);
                 $moratoire->delete();

                 return response()->json([
                     'status_code' => 200,
                     'status_message' => 'Moratoire supprimer',
                     'data' => $moratoire
                 ]);
             } else {
                 return response()->json([
                     'status_code' => 422,
                     'status_message' => 'Moratoire introuvable'
                 ]);
             }
         } catch(Exception $e) {
             return response()->json($e);
         }
     }

     // afficher les informations d'un moratoire
     public function show($id)
     {
         try {
             if($id) {
                 $moratoire = Moratoire::find($id);
                 return response()->json([
                     'status_message' => 'detail du moratoire',
                     'data' => $moratoire
                 ]);
             } else {

                 return response()->json([
                     'status_code' => 422,
                 'status_message' => 'moratoire non existant'
                 ]);
             }
         } catch(Exception $e) {
             return response()->json($e);
         }


     }

     //afficher les moratoires d'une tranche

     public function moratoire($id)
     {
         try{
             if($id)
             {
                 $moratoire = Moratoire::where('moratoires.tranche_id', $id)->get();

                 if($moratoire->isEmpty())
                 {
                     return response()->json(["status_message" => "Aucun moratoire pour cette tranche"]);
                 }

                 return response()->json([
                     'status_message' => 'moratoire  de la tranche',
                     'data' => $moratoire
                 ]);
             }else {
                 return response()->json([
                 'status_code' => 422,
                 'status_message' => 'moratoire non existant'
                 ]);
             }

         } catch(Exception $e)
         {
             return response()->json($e);
         }

     }
}
