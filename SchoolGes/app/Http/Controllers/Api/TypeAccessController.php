<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeAccess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeAccessStoreRequest;

class TypeAccessController extends Controller
{
    public function index(Request $request)
    {

        $typeaccess = TypeAccess::all();
        if ($request->wantsJson()) {
            return response()->json(["typeaccess_list" => $typeaccess]);
        }
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Succes🤩🤩😍.',
            'data' => $typeaccess
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
    public function store(TypeAccessStoreRequest $request)
    {
        //   dd($request);

        try {
            $typeaccess = new TypeAccess();
            $typeaccess->acces_validation = $request->acces_validation;
            $typeaccess->validite = $request->validite;
            $typeaccess->description = $request->description;
            $typeaccess->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le typeaccess a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                'data' => $typeaccess
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
        $typeaccess = TypeAccess::find($id);
        if (!$typeaccess) {
            return response()->json([
                'message' => 'typeaccess And  Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'items' => $typeaccess
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $typeaccess = TypeAccess::find($id);
        if (!$typeaccess) {
            return response()->json([
                'message' => 'typeaccess Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'typeaccess' => $typeaccess
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeAccessStoreRequest $request,  TypeAccess $typeaccess)
    {
        // dd($typeaccess);
        try {
            // Update typeaccess

            $typeaccess->acces_validation = $request->acces_validation;
            $typeaccess->validite = $request->validite;
            $typeaccess->description = $request->description;
            $typeaccess->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la typeaccess a ete Modifier avec success😎😎😎😎😎😎😎😎😎!!!!!.',
                'data' => $typeaccess
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(TypeAccess $typeaccess)
    {


        try {
            if ($typeaccess) {
                $typeaccess->delete();
                //Return Json Response
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Le typeaccess a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
                    'data' => $typeaccess
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Enregistrement introuvable😢😢😢😢.',
                    'data' => $typeaccess
                ]);
            }
        } catch (\Exception $e) {
            //response json
            return response()->json($e);
        }
    }
}
