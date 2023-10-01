<?php

namespace App\Http\Controllers\Api;

use App\Models\Eleve;
use Illuminate\Http\Request;
use App\Models\Insolvabiliter;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsolvabiliterStoreRequest;

class InsolvabiliterController extends Controller
{
    public function index()
    {
        //All Bus
        $Insolvabiliters = Insolvabiliter::all();
        // Return Json Response

        return response()->json([
            'Insolvabiliters' => $Insolvabiliters
        ], 200);
    }





    /**
     * lister les Insolvabiliter d'un eleve.
     */
    public function showInsolve($id)
    {
        $verif = Eleve::find($id);
        if (!$verif) {
            # code...
            return response()->json(["message" => "eleve n'existe pas"]);
        }
        $allInsolvabiliter = Insolvabiliter::where('eleve_id',$id)->get();
        if ($allInsolvabiliter->isEmpty()) {
            # code...
            return response()->json(["message" => "aucun Insolvabiliter pour cette eleve"]);
        }
        return response()->json([
            "message" => "les Insolvabiliters pour cet eleve",
            "Insolvabiliters" => $allInsolvabiliter
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsolvabiliterStoreRequest $request)
    {
        //   dd($request);
        $verif = Eleve::find($request->eleve_id);
        if (!$verif) {
            # code...
            return response()->json([
              'status_code' => 404,
              'status_message' => 'L\'eleve n\'existe pas!!!!!'
            ]);
        }
        try {
            $Insolvabiliters = new Insolvabiliter();
            $Insolvabiliters->eleve_id = $request->eleve_id;
            $Insolvabiliters->date_debut = $request->date_debut;
            $Insolvabiliters->date_fin = $request->date_fin;
            $Insolvabiliters->periode_debut = $request->periode_debut;
            $Insolvabiliters->periode_fin = $request->periode_fin;
            $Insolvabiliters->description = $request->description;
            $Insolvabiliters->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le Insolvabiliters a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                'data' => $Insolvabiliters
            ]);
        } catch (\Exception $e) {
            //response json
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Classe details
        $Insolvabiliters = Insolvabiliter::find($id);
        if (!$Insolvabiliters) {
            return response()->json([
                'message' => 'Insolvabiliters And  Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'items' => $Insolvabiliters
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $Insolvabiliters = Insolvabiliter::find($id);
        if (!$Insolvabiliters) {
            return response()->json([
                'message' => 'Insolvabiliters Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'Insolvabiliters' => $Insolvabiliters
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsolvabiliterStoreRequest $request,  Insolvabiliter $Insolvabiliters)
    {
        // dd($Insolvabiliters);
        $verif = Eleve::find($request->eleve_id);
        if (!$verif) {
            # code...
            return response()->json([
              'status_code' => 404,
              'status_message' => 'L\'eleve n\'existe pas!!!!!'
            ]);
        }
        try {
            // Update Insolvabiliters

            $Insolvabiliters->eleve_id = $request->eleve_id;
            $Insolvabiliters->date_debut = $request->date_debut;
            $Insolvabiliters->date_fin = $request->date_fin;
            $Insolvabiliters->periode_debut = $request->periode_debut;
            $Insolvabiliters->periode_fin = $request->periode_fin;
            $Insolvabiliters->description = $request->description;
            $Insolvabiliters->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la Insolvabiliters a ete Modifier avec success😎😎😎😎😎😎😎😎😎!!!!!.',
                'data' => $Insolvabiliters
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */



    public function destroy(string $id)
    {
        //Detail
        $Insolvabiliters = Insolvabiliter::find($id);
        if (!$Insolvabiliters) {
            return response()->json([
                'message' => 'Insolvabiliters Not Found.'
            ], 404);
        }



        //Delete Insolvabiliters
        $Insolvabiliters->delete();

        //Return Json Response
        return response()->json([
            'message' => 'Insolvabiliters successfully deleted'
        ], 200);
    }
}
