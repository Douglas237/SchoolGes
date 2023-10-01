<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Models\ComplexSportif;
use App\Http\Controllers\Controller;
use App\Models\EtablissementSecondaire;
use Illuminate\Support\Facades\Validator;

class EtablissementSecondaireController extends Controller
{
    public function index(Request $request)
    {

        $Ets = EtablissementSecondaire::all();
        $Ets_secon = Etablissement::find($Ets);
        $complex = ComplexSportif::find($Ets);
        if ($request->wantsJson()) {
            return response()->json(["Etablissemnt_secondaire_list" => [$Ets_secon,$complex]]);
        }
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Succes🤩🤩😍.',
            'data' =>[$Ets_secon,$complex]
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_ETABLISSEMENT' => 'required',
            'ID_COMPLEX_SPORTIF' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $Ets = new EtablissementSecondaire();

            $Ets->ID_ETABLISSEMENT  = $request->ID_ETABLISSEMENT ;
            $Ets->ID_COMPLEX_SPORTIF  = $request->ID_COMPLEX_SPORTIF ;
            $Ets->description = $request->description;
            $Ets->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $Ets
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'mesage' => 'Echec de votre operation'
            ], 500);
        }
    }

    public function show($id)
    {
        $Ets = Etablissement::find($id);
        $complex = ComplexSportif::find($id);
        if ($Ets != null || $complex != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => [$Ets,$complex]
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function edit($id)
    {
        $Ets = Etablissement::find($id);
        $complex = ComplexSportif::find($id);
        if ($Ets != null || $complex != null)  {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => [$Ets,$complex]
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function update(Request $request)
    {
        try {
            $Ets = Etablissement::find($request->id);
            $complex = ComplexSportif::find($request->id);
            $res = $Ets.'+'.$complex;
            if ($res == null) {
                return back();
            }
            $Ets->personne_id = $request->personne_id;
            $Ets->description = $request->description;
            $Ets->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification de Etablissement Secondaire effectuer avec success😎😎.',
                'data' => $Ets
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }
    public function delete($id)
    {
        $Ets  = EtablissementSecondaire::find($id)->delete();
        if (!$Ets) {
            return response()->json([
                'message' => 'billet Not Found.'
            ], 404);
        }
        $Ets->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'La billet a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
            'data' => $Ets
        ]);
    }
}
