<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\periodeStoreRequest;
use App\Models\Etablissement;
use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        //All Bus
        $periodes = Periode::all();
        // Return Json Response

        return response()->json([
            'periodes' => $periodes
        ], 200);
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
    public function store(periodeStoreRequest $request)
    {
        //   dd($request);

        try {
            // $date1 = $request->HEUR_DEBUT;
            // $date2 = $request->HEURE_FIN;
            // $duration = $date1->diff($date2);
            $periodes = new Periode();
            $periodes->NUM_PERIODE = $request->NUM_PERIODE;
            $periodes->libeller = $request->libeller;
            $periodes->HEURE_DEBUT = $request->HEURE_DEBUT;
            $periodes->HEURE_FIN = $request->HEURE_FIN;
            $periodes->valeur_reelle = $request->valeur_reelle;
            $periodes->pause = $request->pause;
            $periodes->description = $request->description;
            $periodes->etablissement_id = $request->etablissement_id;

            $periodes->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le periodes a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                'data' => $periodes
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
        $periodes = Periode::find($id);
        if (!$periodes ) {
            return response()->json([
                'message' => 'periodes Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'items' => $periodes
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $periodes = Periode::find($id);
        $etablissement = Etablissement::findOrfail($id);
        if (!$periodes) {
            return response()->json([
                'message' => 'periodes Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'periodes' => $periodes
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(periodeStoreRequest $request,  Periode $periodes)
    {
        // dd($periodes);
        try {
            // Update periodes

            $periodes->NUM_PERIODE = $request->NUM_PERIODE;
            $periodes->libeller = $request->libeller;
            $periodes->HEURE_DEBUT = $request->HEURE_DEBUT;
            $periodes->HEURE_FIN = $request->HEURE_FIN;
            $periodes->description = $request->description;
            $periodes->etablissement_id = $request->etablissement_id;
            $periodes->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la periodes a ete Modifier avec success😎😎😎😎😎😎😎😎😎!!!!!.',
                'data' => $periodes
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function delete(Periode $periodes)
    // {


    //     try {
    //         if ($periodes) {
    //             $periodes->delete();
    //             //Return Json Response
    //             return response()->json([
    //                 'status_code' => 200,
    //                 'status_message' => 'Le periodes a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
    //                 'data' => $periodes
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'status_code' => 422,
    //                 'status_message' => 'Enregistrement introuvable😢😢😢😢.',
    //                 'data' => $periodes
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         //response json
    //         return response()->json($e);
    //     }
    // }

    public function destroy(string $id)
    {
        //Detail
        $Periode = Periode::find($id);
        if (!$Periode) {
            return response()->json([
                'message' => 'Periode Not Found.'
            ], 404);
        }



        //Delete Periode
        $Periode->delete();

        //Return Json Response
        return response()->json([
            'message' => 'Periode successfully deleted'
        ], 200);
    }

}
