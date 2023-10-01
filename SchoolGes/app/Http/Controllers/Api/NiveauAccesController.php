<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NiveauAccesStoreRequest;
use App\Models\NiveauAcces;
use Illuminate\Http\Request;

class NiveauAccesController extends Controller
{
    public function index()
    {
        try {
            $niveau = NiveauAcces::all();
            return response()->json([
                'statut_code' => 200,
                'statut_message' => "Liste des niveauux d'acces",
                'data' => $niveau
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
    public function store(NiveauAccesStoreRequest $request)
    {
        //   dd($request);

        try {
            $niveau_d_acces = new NiveauAcces();
            $niveau_d_acces->LIBELLER = $request->LIBELLER;
            $niveau_d_acces->DATE_CREATION = $request->DATE_CREATION;
            $niveau_d_acces->description = $request->description;
            $niveau_d_acces->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le niveau_d_acces a ete Ajoute avec success!!!!!.',
                'data' => $niveau_d_acces
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
        $niveau_d_acces = NiveauAcces::find($id);
        if (!$niveau_d_acces) {
            return response()->json([
                'message' => 'niveau_d_acces And  Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'items' => [$niveau_d_acces]
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $niveau_d_acces = NiveauAcces::find($id);
        if (!$niveau_d_acces) {
            return response()->json([
                'message' => 'niveau_d_acces Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'niveau_d_acces' => $niveau_d_acces
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NiveauAccesStoreRequest $request,  NiveauAcces $niveau_d_acces)
    {
        // dd($niveau_d_acces);
        try {
            // Update niveau_d_acces

            $niveau_d_acces->LIBELLER = $request->LIBELLER;
            $niveau_d_acces->DATE_CREATION = $request->DATE_CREATION;
            $niveau_d_acces->description = $request->description;
            $niveau_d_acces->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la niveau_d_acces a ete Modifier avec success!!!!!.',
                'data' => $niveau_d_acces
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {




        try {

            $niveau_d_acces = NiveauAcces::find($id);
            if (!$niveau_d_acces) {
                return response()->json([
                    'message' => 'niveau_d_acces Not Found.'
                ], 404);
            }



            //Delete niveau_d_acces
            $niveau_d_acces->delete();

            //Return Json Response
            return response()->json([
                'message' => 'niveau_d_acces successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json($e);

        }


    }
}
