<?php

namespace App\Http\Controllers\Api;

use App\Models\Fonction;
use App\Models\SalleBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FonctionController extends Controller
{
    public function index(Request $request)
    {

        $Fonction = Fonction::all();
        // $sls = SalleSecondaire::find($Fonction);
        if ($request->wantsJson()) {
            return response()->json(["Etablissemnt_secondaire_list" => $Fonction]);
        }
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Succes🤩🤩😍.',
            'data' =>$Fonction
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_fonction' => 'required',
            // 'id_salle_secondaire' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $Fonction = new Fonction();

            $Fonction->nom_fonction  = $request->nom_fonction ;
            // $Fonction->id_salle_secondaire  = $request->id_salle_secondaire ;
            $Fonction->description = $request->description;
            $Fonction->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $Fonction
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'mesage' => 'Echec de votre operation'
            ], 500);
        }
    }

    public function show($id)
    {
        $Fonction = Fonction::find($id);
        // $sls = SalleSecondaire::find($id);
        if ($Fonction != null )  {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $Fonction
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function edit($id)
    {
        $Fonction = Fonction::find($id);
        // $sls = SalleSecondaire::find($id);
        if ($Fonction != null)  {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $Fonction
            ]);
        }
        return response()->json([
            'message' => 'Fonction Not Found.'
        ], 404);
    }

    public function update(Request $request,$id)
    {
        try {
            $Fonction = Fonction::find($id);
            // $sls = SalleSecondaire::find($request->id);
            // $res = $Fonction.'+'.$sls;
            if ($Fonction == null) {
                return response()->json([
                    'message' =>'salle base not found!'
                ]);
            }
            $Fonction->nom_fonction  = $request->nom_fonction ;
            // $Fonction->id_salle_secondaire  = $request->id_salle_secondaire ;
            $Fonction->description = $request->description;
            $Fonction->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification de la fonction a ete  effectuer avec success😎😎.',
                'data' => $Fonction
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }


    public function delete(Fonction $Fonction)
    {


        try {
            if ($Fonction) {
                $Fonction->delete();
                //Return Json Response
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'La Fonction a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
                    'data' => $Fonction
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Enregistrement introuvable😢😢😢😢.',
                    'data' => $Fonction
                ]);
            }
        } catch (\Exception $e) {
            //response json
            return response()->json($e);
        }
    }

}
