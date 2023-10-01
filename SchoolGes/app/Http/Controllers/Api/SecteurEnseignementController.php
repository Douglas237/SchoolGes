<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecteurEnseignementStoreRequest;
use App\Models\SecteurEnseignement;
use Illuminate\Http\Request;

class SecteurEnseignementController extends Controller
{
    public function index()
    {
        //All Product
        $secteurs = SecteurEnseignement::all();
        // Return Json Response

        return response()->json([
            'secteurs' => $secteurs
        ], 200);
    }



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SecteurEnseignementStoreRequest $request)
    {
        //   dd($request);

        try {
            $secteurs = new SecteurEnseignement();
            $secteurs->libeller = $request->libeller;
            $secteurs->description = $request->description;
            $secteurs->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le secteurs a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                'data' => $secteurs
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
        $secteurs = SecteurEnseignement::find($id);
        if (!$secteurs ) {
            return response()->json([
                'message' => 'secteurs  Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'items' => [$secteurs]
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $secteurs = SecteurEnseignement::find($id);
        if (!$secteurs) {
            return response()->json([
                'message' => 'secteurs Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'secteurs' => $secteurs
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SecteurEnseignementStoreRequest $request,  SecteurEnseignement $secteurs)
    {
        // dd($secteurs);
        try {
            // Update secteurs

            $secteurs->libeller = $request->libeller;
            $secteurs->description = $request->description;
            $secteurs->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la secteurs a ete Modifier avec success😎😎😎😎😎😎😎😎😎!!!!!.',
                'data' => $secteurs
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }


    public  function destroy($id)
    {
        try {
            if($id) {
                $secteurs = SecteurEnseignementStoreRequest::find($id);
                $secteurs->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'secteurs supprimer',
                    'data' => $secteurs
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'secteurs introuvable'
                ]);
            }
        } catch(\Exception $e) {
            return response()->json($e);
        }
    }
}
