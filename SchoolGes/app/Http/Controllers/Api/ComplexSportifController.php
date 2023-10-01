<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\ComplexSportif;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplexSportifRequest;
use App\Http\Requests\UpdateComplexSportifRequest;
use App\Models\Etablissement;

class ComplexSportifController extends Controller
{
    // listing des complexes sportif
    public function index()
    {
        try
        {
            $complexsportif = ComplexSportif::all();
            return response()->json([
                'statut_code' => 200,
                'statut_message' =>'liste des complexes sportifs',
                'data' => $complexsportif
            ]);

        }
        catch(Exception $e){
            return response()->json($e);
        }

    }

    //creation d'un complexe sportif

    public function store(StoreComplexSportifRequest $request)
    {
        try{
            $etablissement = Etablissement::where('etablissements.id', $request->etablissement_id)->get();

            // dd($etablissement);

            if($etablissement->isEmpty())
            {
                return response()->json(["status_message" => "cet etablissement n'existe pas"]);
            }
            $complexsportif = ComplexSportif::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le complex sportif a ete ajouté',
                'data' => $complexsportif
            ]);
        }
        catch(Exception $e){
            return response()->json($e);
        }
    }

    // modification du complexe sportif
    public function update(UpdateComplexSportifRequest $request, $id)
    {
        try {
            $etablissement = Etablissement::where('etablissements.id', $request->etablissement_id)->get();

            if($etablissement->isEmpty())
            {
                return response()->json(["status_message" => "cet etablissement n'existe pas"]);
            }

            $complexsportif = ComplexSportif::find($id);
            $complexsportif->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'le complexe a ete modifier',
                'data' => $complexsportif
            ]);

        }
        catch(Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification du complexe sportif',
            ]);
        }

    }

    // supprimer un complexe sportif existant
    public  function destroy($id)
    {
        try {
            if($id) {
                $complexsportif = ComplexSportif::find($id);
                $complexsportif->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'complexe sportif supprimer',
                    'data' => $complexsportif
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'complexe sportif non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un complexe sportif
    public function show($id)
    {
        try {
            if($id) {
                $complexsportif = ComplexSportif::find($id);
                return response()->json([
                    'status_message' => 'detail du complexe sportif',
                    'data' => $complexsportif
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                'status_message' => 'complexe sportif non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }


    }

}
