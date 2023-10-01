<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\LivreProgramme;
use App\Http\Controllers\Controller;
use App\Http\Requests\LivresProgrammeStoreRequest;

class LivresProgrammeController extends Controller
{
    public function index()
    {
        //All Bus
        $livreprogrammes = LivreProgramme::all();
        // Return Json Response

        return response()->json([
            'livreprogrammes' => $livreprogrammes
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
    public function store(LivresProgrammeStoreRequest $request)
    {
        //   dd($request);

        try {
            $livreprogrammes = new LivreProgramme();
            $livreprogrammes->TITRE_LIVRE = $request->TITRE_LIVRE;
            $livreprogrammes->DOMAINE = $request->DOMAINE;
            $livreprogrammes->GROUPEMENT = $request->GROUPEMENT;
            $livreprogrammes->EDITION = $request->EDITION;
            $livreprogrammes->description = $request->description;
            $livreprogrammes->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le livreprogrammes a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                'data' => $livreprogrammes
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
        $livreprogrammes = LivreProgramme::find($id);
        if (!$livreprogrammes) {
            return response()->json([
                'message' => 'livreprogrammes Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'livreprogrammes' => $livreprogrammes
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $livreprogrammes = LivreProgramme::find($id);
        if (!$livreprogrammes) {
            return response()->json([
                'message' => 'livreprogrammes Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'livreprogrammes' => $livreprogrammes
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LivresProgrammeStoreRequest $request,  LivreProgramme $livreprogrammes)
    {
        // dd($livreprogrammes);
        try {
            // Update livreprogrammes

            $livreprogrammes->TITRE_LIVRE = $request->TITRE_LIVRE;
            $livreprogrammes->DOMAINE = $request->DOMAINE;
            $livreprogrammes->GROUPEMENT = $request->GROUPEMENT;
            $livreprogrammes->EDITION = $request->EDITION;
            $livreprogrammes->description = $request->description;
            $livreprogrammes->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la livreprogrammes a ete Modifier avec success😎😎😎😎😎😎😎😎😎!!!!!.',
                'data' => $livreprogrammes
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(LivreProgramme $livreprogrammes)
    {


        try {
            if ($livreprogrammes) {
                $livreprogrammes->delete();
                //Return Json Response
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Le livreprogrammes a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
                    'data' => $livreprogrammes
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Enregistrement introuvable😢😢😢😢.',
                    'data' => $livreprogrammes
                ]);
            }
        } catch (\Exception $e) {
            //response json
            return response()->json($e);
        }
    }
}
