<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Controle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreControleRequest;
use App\Http\Requests\UpdateControleRequest;
use App\Models\Sequence;

class ControleController extends Controller
{
      // liste des controles
      public function index()
      {
          $controle = Controle::all();
          return response()->json([
              'statut_code' => 200,
              'statut_message' =>'liste des controles',
              'data' => $controle
          ]);
      }


    //creation d'un controle

    public function store(StoreControleRequest  $request)
    {

        try{
            $sequence = Sequence::where('sequences.id', $request->sequence_id)->get();
            if($sequence->isEmpty())
            {
                return response()->json([
                    'status_message' => 'Aucune sequence selectionner'
                ]);
            }
            // dd($sequence);
            $controle = Controle::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'controle ajouté',
                'data' => $controle
            ]);
        }
        catch(Exception $e){
            return response()->json($e);
        }
    }

    // modification d'un controle
    public function update(UpdateControleRequest $request, $id)
    {
        try {

            $sequence = Sequence::where('sequences.id', $request->sequence_id)->get();
            if($sequence->isEmpty())
            {
                return response()->json([
                    'status_message' => 'Aucune sequence selectionner'
                ]);
            }

            $controle = Controle::Find($id);
            $controle->update($request->validated());


            return response()->json([
                'status_code' => 200,
                'status_message' => 'controle modifier',
                'data' => $controle
            ]);

        }
        catch(Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }

    }

    // supprimer un controle
    public  function destroy($id)
    {
        try {
            if($id) {
                $controle = Controle::find($id);
                $controle->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'controle supprimer',
                    'data' => $controle
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'controle introuvable'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un controle
    public function show($id)
    {
        try {
            if($id) {
                $controle = Controle::find($id);
                return response()->json([
                    'status_message' => 'detail du controle',
                    'data' => $controle
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                'status_message' => 'controle non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }

    }

    //afficher les controles d'une sequence

    public function controle($id)
    {
        try{
            if($id)
            {
                $controle = Controle::where('controles.sequence_id', $id)->get();

                if($controle->isEmpty())
                {
                    return response()->json(["status_message" => "Pas de controle pour cette sequence"]);
                }

                return response()->json([
                    'status_message' => 'controle pour cette sequence',
                    'data' => $controle
                ]);
            }else {
                return response()->json([
                'status_code' => 422,
                'status_message' => 'controle non existant'
                ]);
            }

        } catch(Exception $e)
        {
            return response()->json($e);
        }

    }
}
