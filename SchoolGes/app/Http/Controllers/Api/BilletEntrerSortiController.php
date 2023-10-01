<?php

namespace App\Http\Controllers\Api;

use App\Models\Personne;
use Illuminate\Http\Request;
use App\Models\BilletEntrerSorti;
use App\Http\Controllers\Controller;
use App\Http\Resources\BilletResource;
use Illuminate\Support\Facades\Validator;

class BilletEntrerSortiController extends Controller
{
    public function index()
    {


        try {
            //code...
            $Billet = BilletResource::collection(BilletEntrerSorti::all());
            return $Billet;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'CLASSE' => 'required',
            'SALLE' => 'required',
            'MOTIF' => 'required',
            'description' => 'required',
            'eleve_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $billet = new BilletEntrerSorti();
            $billet->CLASSE = $request->CLASSE;
            $billet->SALLE = $request->SALLE;
            $billet->MOTIF = $request->MOTIF;
            $billet->description = $request->description;
            $billet->eleve_id = $request->eleve_id;
            $billet->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $billet
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'mesage' => 'Echec de votre operation'
            ], 500);
        }
    }

    public function show($id)
    {
        $billet = BilletEntrerSorti::find($id);
        if ($billet != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => ' view success😎😎.',
                'data' => $billet
            ]);
        }
        return response()->json([
            'message' => 'view Not Found.'
        ], 404);
    }

    public function edit($id)
    {
        $billet = BilletEntrerSorti::find($id);
        if ($billet != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $billet
            ]);
        }
        return response()->json([
            'message' => 'edit Not Found.'
        ], 404);
    }

    public function update(Request $request)
    {
        try {
            $billet = BilletEntrerSorti::find($request->id);
            if ($billet == null) {
                return back();
            }
            $billet->CLASSE = $request->CLASSE;
            $billet->SALLE = $request->SALLE;
            $billet->MOTIF = $request->MOTIF;
            $billet->description = $request->description;
            $billet->eleve_id = $request->eleve_id;
            $billet->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification du billet effectuer avecsuccess😎😎.',
                'data' => $billet
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }
    public function delete($id)
    {
        $billet  = BilletEntrerSorti::find($id);
        if (!$billet) {
            return response()->json([
                'message' => 'billet Not Found.'
            ], 404);
        }
        $billet->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'La billet a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
            'data' => $billet
        ]);
    }
}
