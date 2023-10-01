<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Periode;
use App\Models\SalleBase;
use Illuminate\Http\Request;
use App\Models\ProgrammeSalle;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProgrammeSalleRequest;
use App\Http\Requests\UpdateProgrammeSalleRequest;

class ProgrammeSalleController extends Controller
{
        // liste des programmes
        public function index()
        {
            $programme = ProgrammeSalle::all();
            return response()->json([
                'statut_code' => 200,
                'statut_message' =>'liste des programmes',
                'data' => $programme
            ]);
        }


      //creation d'un programme de salle

      public function store(StoreProgrammeSalleRequest $request)
      {
          try{

              $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();
              // dd($sallebase);
              $periode = Periode::where('periodes.id', $request->periode_id)->get();

              if($sallebase->isEmpty() || $periode->isEmpty())
              {
                  return response()->json(["status_message" => "salle de base ou periode non existante"]);
              }

              $programmesalle = ProgrammeSalle::create($request->validated());

              return response()->json([
                  'status_code' => 200,
                  'status_message' => 'programme de salle ajouté',
                  'data' => $programmesalle
              ]);
          }
          catch(Exception $e){
              return response()->json($e);
          }
      }

      // modification d'un programme de salle
      public function update(UpdateProgrammeSalleRequest $request, $id)
      {
          try {

              $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();

              $periode = Periode::where('periodes.id', $request->periode_id)->get();

              if($sallebase->isEmpty() || $periode->isEmpty())
              {
                  return response()->json(["status_message" => "salle de base ou periode non existante"]);
              }
              $programmesalle = ProgrammeSalle::Find($id);
              // dd($fichepresencejour);
              $programmesalle->update($request->validated());

              return response()->json([
                  'status_code' => 200,
                  'status_message' => 'Programme modifier',
                  'data' => $programmesalle
              ]);

          }
          catch(Exception $e) {
              return response()->json([
                  'status_code' => 422,
                  'status_message' => 'erreur de modification'
              ]);
          }

      }

      // supprimer d'un programme
      public  function destroy($id)
      {
          try {
              if($id) {
                  $programme = ProgrammeSalle::find($id);
                  $programme->delete();

                  return response()->json([
                      'status_code' => 200,
                      'status_message' => 'programme supprimer',
                      'data' => $programme
                  ]);
              } else {
                  return response()->json([
                      'status_code' => 422,
                      'status_message' => 'programme introuvable'
                  ]);
              }
          } catch(Exception $e) {
              return response()->json($e);
          }
      }

      // afficher les informations d'un programme
      public function show($id)
      {
          try {
              if($id)
               {
                  $programme = ProgrammeSalle::find($id);
                  return response()->json([
                      'status_message' => 'detail du programme',
                      'data' => $programme
                  ]);
              } else {

                  return response()->json([
                      'status_code' => 422,
                  'status_message' => 'Programme non existant'
                  ]);
              }
          } catch(Exception $e) {
              return response()->json($e);
          }


      }

      //afficher le programme d'une salle a une periode

      public function Programmesalle($id)
      {
          try{
              if($id)
              {
                  $programme = ProgrammeSalle::where('programme_salles.sallebase_id','programme_salles.periode_id', $id)->get();
                  // dd($fichesalle);
                  if($programme->isEmpty())
                  {
                      return response()->json(["status_message" => "Aucune programme trouver pour cette salles"]);
                  }

                  return response()->json([
                      'status_message' => 'programme de la salle',
                      'data' => $programme
                  ]);
              }else {
                  return response()->json([
                  'status_code' => 422,
                  'status_message' => 'programme non existant'
                  ]);
              }

          } catch(Exception $e)
          {
              return response()->json($e);
          }


      }
}
