<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SequencesStoreRequest;
use App\Models\Sequence;
use Illuminate\Http\Request;

class SequencesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $sequences = Sequence::all();
            if ($request->wantsJson()) {
                return response()->json(["sequences_list" => $sequences]);
            }
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $sequences
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
    public function store(SequencesStoreRequest $request)
    {
        //   dd($request);

        try {
            $sequences = new Sequence();
            $sequences->num_sequences = $request->num_sequences;
            $sequences->libeller = $request->libeller;
            $sequences->DEBUT_COURS = $request->DEBUT_COURS;
            $sequences->FIN_COURS = $request->FIN_COURS;
            $sequences->DEBUT_EVALUATION = $request->DEBUT_EVALUATION;
            $sequences->FIN_EVALUATION = $request->FIN_EVALUATION;
            $sequences->DEBUT_RESULTAT = $request->DEBUT_RESULTAT;
            $sequences->FIN_RESULTAT = $request->FIN_RESULTAT;
            $sequences->trimestre_id = $request->trimestre_id;
            $sequences->description = $request->description;
            $sequences->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le sequences a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                'data' => $sequences
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
        $sequences = Sequence::find($id);
        if (!$sequences) {
            return response()->json([
                'message' => 'sequences Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'sequences' => $sequences
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $sequences = Sequence::find($id);
        if (!$sequences) {
            return response()->json([
                'message' => 'sequences Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'sequences' => $sequences
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SequencesStoreRequest $request,  Sequence $sequences)
    {
        // dd($sequences);
        try {
            // Update sequences

            $sequences->num_sequences = $request->num_sequences;
            $sequences->libeller = $request->libeller;
            $sequences->DEBUT_COURS = $request->DEBUT_COURS;
            $sequences->FIN_COURS = $request->FIN_COURS;
            $sequences->DEBUT_EVALUATION = $request->DEBUT_EVALUATION;
            $sequences->FIN_EVALUATION = $request->FIN_EVALUATION;
            $sequences->DEBUT_RESULTAT = $request->DEBUT_RESULTAT;
            $sequences->FIN_RESULTAT = $request->FIN_RESULTAT;
            $sequences->trimestre_id = $request->trimestre_id;
            $sequences->description = $request->description;
            $sequences->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la sequences a ete Modifier avec success😎😎😎😎😎😎😎😎😎!!!!!.',
                'data' => $sequences
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
        $sequences = Sequence::find($id);
        if (!$sequences) {
            return response()->json([
                'message' => 'sequences Not Found.'
            ], 404);
        }



        //Delete sequences
        $sequences->delete();

        //Return Json Response
        return response()->json([
            'message' => 'sequences successfully deleted'
        ], 200);
    }
}
