<?php

namespace App\Http\Controllers\Api;

use App\Models\Tache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TacheStoreRequest;
use App\Models\Personne;
use Illuminate\Support\Facades\Validator;

class TacheController extends Controller
{
    public function index(Request $request)
    {
        try {
            $taches = Tache::all();
            if ($request->wantsJson()) {
                return response()->json(["paimenst_list" => $taches]);
            }
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $taches
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NOM_TACHE' => 'required',
            'DATE_DEBUT' => 'required',
            'HEURE_DEBUT' => 'required',
            'description' => 'required',
            'ID_PERSONNE' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $taches = new Tache();
            $taches->NOM_TACHE = $request->NOM_TACHE;
            $taches->DATE_DEBUT = $request->DATE_DEBUT;
            $taches->HEURE_DEBUT = $request->HEURE_DEBUT;
            $taches->description = $request->description;
            $taches->ID_PERSONNE = $request->ID_PERSONNE;
            $taches->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $taches
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'mesage' => 'Echec de votre operation'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $taches = Tache::find($id);
        $personnes = Personne::find($id);
        $red = $taches . '+' . $personnes;
        if (!$red) {
            return response()->json([
                'message' => 'taches Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'taches' => $taches
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $taches = Tache::find($id);
        $personnes = Personne::find($id);
        $red = $taches . '+' . $personnes;
        if (!$red) {
            return response()->json([
                'message' => 'taches Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'taches' => $taches
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $taches = Personne::find($request->id);
            if ($taches == null) {
                return back();
            }
            $taches->NOM_TACHE = $request->NOM_TACHE;
            $taches->DATE_DEBUT = $request->DATE_DEBUT;
            $taches->HEURE_DEBUT = $request->HEURE_DEBUT;
            $taches->description = $request->description;
            $taches->ID_PERSONNE = $request->ID_PERSONNE;
            $taches->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification du taches effectuer avecsuccess😎😎.',
                'data' => $taches
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Tache $taches)
    {


        try {
            if ($taches) {
                $taches->delete();
                //Return Json Response
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Le taches a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
                    'data' => $taches
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Enregistrement introuvable😢😢😢😢.',
                    'data' => $taches
                ]);
            }
        } catch (\Exception $e) {
            //response json
            return response()->json($e);
        }
    }
}
