<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TypeEnseignant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TypeEnseignantController extends Controller
{
    public function index(Request $request)
    {

        $typeenseignant = TypeEnseignant::all();
        if ($request->wantsJson()) {
            return response()->json(["typeenseignant" => $typeenseignant]);
        }
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Succes🤩🤩😍.',
            'data' => $typeenseignant
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libeller' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $typeenseignant = new TypeEnseignant();
            $typeenseignant->libeller = $request->libeller;
            $typeenseignant->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $typeenseignant
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'mesage' => 'Echec de votre operation'
            ], 500);
        }
    }

    public function show($id)
    {
        $typeenseignant =TypeEnseignant::find($id);
        if ($typeenseignant != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $typeenseignant
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function edit($id)
    {
        $typeenseignant =TypeEnseignant::find($id);
        if ($typeenseignant != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $typeenseignant
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function update(Request $request,$id)
    {
        try {
            $typeenseignant =TypeEnseignant::find($id);
            if ($typeenseignant == null) {
                return back();
            }
            $typeenseignant->libeller = $request->libeller;
            $typeenseignant->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification du type enseignant effectuer avecsuccess😎😎.',
                'data' => $typeenseignant
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }


    public function destroy(string $id)
    {
        //Detail
        $typeenseignant = TypeEnseignant::find($id);
        if (!$typeenseignant) {
            return response()->json([
                'message' => 'typeenseignant Not Found.'
            ], 404);
        }



        //Delete typeenseignant
        $typeenseignant->delete();

        //Return Json Response
        return response()->json([
            'message' => 'typeenseignant successfully deleted'
        ], 200);
    }

}
