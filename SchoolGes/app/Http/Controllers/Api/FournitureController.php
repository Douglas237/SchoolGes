<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Fourniture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFournitureRequest;
use App\Http\Requests\UpdateFournitureRequest;
use App\Models\SalleBase;

class FournitureController extends Controller
{
      // liste des fournitures
      public function index()
      {
          $fourniture = Fourniture::all();
          return response()->json([
              'statut_code' => 200,
              'statut_message' =>'liste des fournitures',
              'data' => $fourniture
          ]);
      }


    //creation d'une fournitures

    public function store(StoreFournitureRequest  $request)
    {

        try{
            $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();
            if($sallebase->isEmpty())
            {
                return response()->json([
                    'status_message' => 'Aucune salle selectionner'
                ]);
            }
            $fourniture = Fourniture::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'fourniture ajouté',
                'data' => $fourniture
            ]);
        }
        catch(Exception $e){
            return response()->json($e);
        }
    }

    // modification d'une fournitures

    public function update(UpdateFournitureRequest $request, $id)
    {
        try {

            $sallebase = SalleBase::where('salle_bases.id', $request->sallebase_id)->get();
            if($sallebase->isEmpty())
            {
                return response()->json([
                    'status_message' => 'Aucune salle selectionner'
                ]);
            }
            $fourniture = Fourniture::Find($id);
            $fourniture->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'fourniture modifier',
                'data' => $fourniture
            ]);

        }
        catch(Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }

    }

    // supprimer une fourniture

    public  function destroy($id)
    {
        try {
            if($id) {
                $fourniture = Fourniture::find($id);
                $fourniture->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Fourniture supprimer',
                    'data' => $fourniture
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'fourniture introuvable'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'une fourniture
    public function show($id)
    {
        try {
            if($id) {
                $fourniture = Fourniture::find($id);
                return response()->json([
                    'status_message' => 'detail fourniture',
                    'data' => $fourniture
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                'status_message' => 'fourniture non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }

    }
}
