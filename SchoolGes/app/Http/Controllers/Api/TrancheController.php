<?php

namespace App\Http\Controllers\Api;

use App\Models\Tranche;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\TrancheResource;
use Illuminate\Support\Facades\Validator;

class TrancheController extends Controller
{
    public function index()
    {


        try {
            //code...
            $tranches = TrancheResource::collection(Tranche::all());
            return $tranches;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        //  dd($request);
        $validator = Validator::make($request->all(), [
            'NUM_TRANCHE' => 'required',
            'LIBELER' => 'required',
            'MONTANT' => 'required',
            'DATE_FIN' => 'required',
            'description' => 'required',
            'paiement_id' => 'required',
        ]);
        // dd($validator->fails());
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $paiements = Paiement::find($request->paiement_id);
            if ($paiements == null) {
                return response()->json([
                    'mesage' => 'Not null'
                ], 500);
            }
            $tranches = Tranche::all()->where('tranches.paiement_id', '=', $request->paiement_id)->count();
            // dd($tranches);
            if ($tranches !== 0) {

                if ($paiements->montant_totale > $request->montant_totale) {
                    $tran = new Tranche();
                    $tran->NUM_TRANCHE = $request->NUM_TRANCHE;
                    $tran->LIBELER = $request->LIBELER;
                    $tran->MONTANT = $request->MONTANT;
                    $tran->DATE_FIN = $request->DATE_FIN;
                    $tran->description = $request->description;
                    $tran->paiement_id = $request->paiement_id;
                } else {
                    return response()->json([
                        'mesage' => 'erreur zero'
                    ], 500);
                }
                try {
                    $tran->save();
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Succes 001😎😎.',
                        'data' => $tran
                    ]);
                    // return back();
                } catch (\Exception $ex) {
                    return response()->json($ex);
                }
            } else {
                $total = DB::table("tranches")->where('paiement_id', '=', $request->paiement_id)->sum('MONTANT');
                // dd($total);
                $toPay = $paiements->montant_totale - $total;
                if ($toPay >= $request->MONTANT) {
                    // dd($toPay);
                    $tranche = new Tranche();
                    $tranche->NUM_TRANCHE = $request->NUM_TRANCHE;
                    $tranche->LIBELER = $request->LIBELER;
                    $tranche->MONTANT = $request->MONTANT;
                    $tranche->DATE_FIN = $request->DATE_FIN;
                    $tranche->description = $request->description;
                    $tranche->paiement_id = $request->paiement_id;
                    $tranche->save();
                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'Succes 002😎😎.',
                        'data' => $tranche
                    ]);
                } else {
                    return response()->json([
                        'mesage' => 'erreur 003'
                    ], 500);
                }
            }
        } catch (\Exception $ex) {
            return response()->json($ex);
        }



        // $paiements = DB::table('paiements')->get();
        // foreach ($paiements as $paiement) {
        //     # code...
        //     $paiementAmount= $paiement->montant_totale;
        //     $nberTranche=4;
        //     $montantTranches = $paiementAmount/$nberTranche;
        //     for ($i=1;$i<=$nberTranche;$i++){
        //        DB::table('tranches')->insert([
        //            'NUM_TRANCHE'=>$i,
        //            'LIBELER'=>$paiement->LIBELER,
        //            'MONTANT'=>$montantTranches,
        //            'DATE_FIN'=>$paiement->DATE_FIN = now(),
        //            'description'=>$paiement->description,
        //            'paiement_id'=>$paiement->id,
        //         ]);
        //     }
        // }
    }

    public function show($id)
    {
        $tranche = Tranche::find($id);
        if ($tranche != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $tranche
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }


    public function edit($id)
    {
        $tranche = Tranche::find($id);
        if ($tranche != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $tranche
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function update(Request $request,$id)
    {
        try {
            $tranche = Tranche::find($id);
            if ($tranche == null) {
                return back();
            }
            $tranche->NUM_TRANCHE = $request->NUM_TRANCHE;
            $tranche->LIBELER = $request->LIBELER;
            $tranche->MONTANT = $request->MONTANT;
            $tranche->DATE_FIN = $request->DATE_FIN;
            $tranche->description = $request->description;
            $tranche->paiement_id = $request->paiement_id;
            $tranche->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification de la tranche effectuer avecsuccess😎😎.',
                'data' => $tranche
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    public function delete($id)
    {
        $tranche  = Tranche::find($id);
        if (!$tranche) {
            return response()->json([
                'message' => 'Tranche Not Found.'
            ], 404);
        }
        $tranche->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'La Tranche a ete Supprimer avec success!!!!!!!!!!.',
            'data' => $tranche
        ]);
    }
}
