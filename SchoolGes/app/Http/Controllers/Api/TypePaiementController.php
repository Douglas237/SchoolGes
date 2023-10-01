<?php

namespace App\Http\Controllers\Api;

use App\Models\Paiement;
use App\Models\TypePaiement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaiementsTypepaiements;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PaiementTypepaiementResource;
use App\Http\Requests\Paiement_typePaiementStoreRequest;

class TypePaiementController extends Controller
{

        public function index()
        {
            $typepaiements = TypePaiement::all();
            return response()->json([
                'statut_code' => 200,
                'statut_message' =>'liste des typepaiements',
                'data' => $typepaiements
            ]);
        }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NOM_TYPE' => '',
            'autres' => '',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $typepaiements = new TypePaiement();
            $typepaiements->NOM_TYPE = $request->NOM_TYPE;
            $typepaiements->autres = $request->autres;
            $typepaiements->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => [$typepaiements]
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'mesage' => 'Echec de votre operation'
            ], 500);
        }
    }

    public function show($id)
    {
        $typepaiements = TypePaiement::find($id);
        if ($typepaiements != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $typepaiements
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function edit($id)
    {
        $typepaiements = TypePaiement::find($id);
        if ($typepaiements != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $typepaiements
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function update(Request $request,$id)
    {
        try {
            $typepaiements = TypePaiement::find($id);
            if ($typepaiements == null) {
                return response()->json([
                    'status_code' => 404,
                    'status_message' => 'type de paiements est introuvable.',
                ]);
            }
            $typepaiements->NOM_TYPE = $request->NOM_TYPE;
            $typepaiements->autres = $request->autres;
            $typepaiements->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification du typepaiements effectuer avecsuccess😎😎.',
                'data' => $typepaiements
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }
    public function delete($id)
    {
        $typepaiements  = TypePaiement::find($id)->delete();
        if (!$typepaiements) {
            return response()->json([
                'message' => 'typepaiements Not Found.'
            ], 404);
        }
        $typepaiements->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'La typepaiements a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
            'data' => $typepaiements
        ]);
    }
















    public function createAssign(string $id)
    {
        $paiements = Paiement::FindOrFail($id);
        $typepaiements = TypePaiement::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le detachement du paiements et du type de paiements a ete creer avec succes Zone a ete success!!!!!.',
            'data' => $typepaiements,$paiements
        ]);
    }


    // public function storeAssign(Paiement_typePaiementStoreRequest $request)
    // {

    //     try {

    //         // dd($request);
    //         // $zones = Zone::find(6);

    //         $paiements = Paiement::FindOrFail($request->paiement_id);
    //         $typepaiements = TypePaiement::FindOrFail($request->type_paiement_id);
    //         $typepaiements->paiementss()->attach($paiements);
    //         return response()->json([
    //             'status_code' => 200,
    //             'status_message' => 'Le Paiement et le type de Paiements  ont ete assigner avec success!!!!!.',
    //             'data' => $typepaiements
    //         ]);
    //     } catch (\Exception $e) {
    //         // dd($e);
    //         // Toastr::error("Echec d'Assignation");
    //         return response()->json($e);

    //     }
    //                //response json
    //             //    return response()->json($e);
    // }

    // public function createDetach(string  $id)
    // {
    //     $paiements = Paiement::FindOrFail($id);
    //     $typepaiements = TypePaiement::all();
    //     return response()->json([
    //         'status_code' => 200,
    //         'status_message' => 'Le detachement de la Zone a ete creer avec succes Zone a ete success!!!!!.',
    //         'data' => $typepaiements,$paiements
    //     ]);
    // }



    // public function storeDetach(Paiement_typePaiementStoreRequest $request)
    // {


    //     try {


    //         $paiements = Paiement::FindOrFail($request->paiement_id);
    //         $typepaiements = TypePaiement::FindOrFail($request->type_paiement_id);
    //         $typepaiements->paiementss()->detach($paiements);;

    //         return response()->json([
    //             'status_code' => 200,
    //             'status_message' => 'Le detachement reussit!!!!!.',
    //             'data' => $typepaiements
    //         ]);

    //     } catch (\Exception $e) {
    //         // dd($e);
    //         return response()->json($e);

    //     }
    //     // return redirect()->back();
    // }

    // public function viewAttach()
    // {



    //     try {
    //         //code...
    //         $typepaiements = PaiementTypepaiementResource::collection(PaiementsTypepaiements::all());
    //         return $typepaiements;
    //     } catch (\Throwable $e) {
    //         //throw $e;
    //         return response()->json($e);
    //     }
    // }

}
