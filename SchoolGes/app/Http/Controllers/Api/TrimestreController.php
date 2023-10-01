<?php

namespace App\Http\Controllers\Api;

use App\Models\Trimestre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrimestreStoreRequest;

class TrimestreController extends Controller
{
    public function index(Request $request)
    {

        $trimestre = Trimestre::all();
        if ($request->wantsJson()) {
            return response()->json(["Trimestre_list" => $trimestre]);
        }
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Succes🤩🤩😍.',
            'data' => $trimestre
        ]);
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
    public function store(TrimestreStoreRequest $request)
    {
        //   dd($request);

        try {
            $trimestre = new Trimestre();
            $trimestre->num_trimestre = $request->num_trimestre;
            $trimestre->libeller = $request->libeller;
            $trimestre->DEBUT_COURS = $request->DEBUT_COURS;
            $trimestre->FIN_COURS = $request->FIN_COURS;
            $trimestre->DEBUT_EVALUATION = $request->DEBUT_EVALUATION;
            $trimestre->FIN_EVALUATION = $request->FIN_EVALUATION;
            $trimestre->DEBUT_RESULTAT = $request->DEBUT_RESULTAT;
            $trimestre->FIN_RESULTAT = $request->FIN_RESULTAT;
            $trimestre->Debut_Conger = $request->Debut_Conger;
            $trimestre->description = $request->description;
            $trimestre->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le trimestre a ete Ajoute avec success!!!!!.',
                'data' => $trimestre
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
        $trimestre = Trimestre::find($id);
        if (!$trimestre) {
            return response()->json([
                'message' => 'trimestre Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'trimestre' => $trimestre
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $trimestre = Trimestre::find($id);
        if (!$trimestre) {
            return response()->json([
                'message' => 'trimestre Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'trimestre' => $trimestre
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrimestreStorerequest $request,  Trimestre $trimestre)
    {
        // dd($trimestre);
        try {
            // Update trimestre

            $trimestre->num_trimestre = $request->num_trimestre;
            $trimestre->libeller = $request->libeller;
            $trimestre->DEBUT_COURS = $request->DEBUT_COURS;
            $trimestre->FIN_COURS = $request->FIN_COURS;
            $trimestre->DEBUT_EVALUATION = $request->DEBUT_EVALUATION;
            $trimestre->FIN_EVALUATION = $request->FIN_EVALUATION;
            $trimestre->DEBUT_RESULTAT = $request->DEBUT_RESULTAT;
            $trimestre->FIN_RESULTAT = $request->FIN_RESULTAT;
            $trimestre->Debut_Conger = $request->Debut_Conger;
            $trimestre->description = $request->description;
            $trimestre->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la trimestre a ete Modifier avec success!!!!!.',
                'data' => $trimestre
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
        $trimestre = Trimestre::find($id);
        if (!$trimestre) {
            return response()->json([
                'message' => 'trimestre Not Found.'
            ], 404);
        }



        //Delete trimestre
        $trimestre->delete();

        //Return Json Response
        return response()->json([
            'message' => 'trimestre successfully deleted'
        ], 200);
    }

}
