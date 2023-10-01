<?php

namespace App\Http\Controllers\Api;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Paiement;
use Illuminate\Http\Request;
// use App\Models\ElevePaiement;
use App\Models\ElevesPaiement;
use App\Models\ClassesPaiement;
use App\Http\Controllers\Controller;
use App\Http\Resources\EleveResource;
use App\Http\Resources\PaiementResource;
use App\Http\Requests\PaiementStoreRequest;
use App\Http\Resources\ElevePaiementResource;
use App\Http\Resources\ClassePaiementResource;
use App\Http\Requests\ElevePaiementStoreRequest;
use App\Http\Requests\ClassePaiementStoreRequest;

class PaiementController extends Controller
{


    public function index()
    {


        try {
            //code...
            $Classepaiements = PaiementResource::collection(Paiement::all());
            return $Classepaiements;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }





    /**
     * lister les paiement d'un eleve.
     */
    public function showPaiment($id)
    {
        $verif = Eleve::find($id);
        if (!$verif) {
            # code...
            return response()->json(["message" => "eleve n'existe pas"]);
        }
        $allpaiement = Paiement::where('eleve_id',$id)->get();
        if ($allpaiement->isEmpty()) {
            # code...
            return response()->json(["message" => "aucun paiement pour cette eleve"]);
        }
        return response()->json([
            "message" => "les paiements pour cet eleve",
            "paiement" => $allpaiement
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaiementStoreRequest $request)
    {

        try {
            $paiements = new Paiement();
            $paiements->montant_totale = $request->montant_totale;
            $paiements->Avance = $request->Avance;
            $paiements->tranches = $request->tranches;
            $paiements->moratoire = $request->moratoire;
            $paiements->type_paiement_id = $request->type_paiement_id;
            $paiements->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le paiements a ete Ajoute avec success!!!!!.',
                'data' => $paiements
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
        $paiements = Paiement::find($id);
        if (!$paiements) {
            return response()->json([
                'message' => 'paiements And  Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'items' => $paiements
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $paiements = Paiement::find($id);
        if (!$paiements) {
            return response()->json([
                'message' => 'paiements Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'paiements' => $paiements
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaiementStoreRequest $request,  Paiement $paiements)
    {

        try {
            // Update paiements
            $paiements->montant_totale = $request->montant_totale;
            $paiements->Avance = $request->Avance;
            $paiements->tranches = $request->tranches;
            $paiements->moratoire = $request->moratoire;
            $paiements->type_paiement_id = $request->type_paiement_id;
            $paiements->update();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la paiements a ete Modifier avec success😎😎😎😎😎😎😎😎😎!!!!!.',
                'data' => $paiements
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */



    public function destroy(string $id)
    {
        //Detail
        $paiements = Paiement::find($id);
        if (!$paiements) {
            return response()->json([
                'message' => 'paiements Not Found.'
            ], 404);
        }



        //Delete paiements
        $paiements->delete();

        //Return Json Response
        return response()->json([
            'message' => 'paiements successfully deleted'
        ], 200);
    }



    public function createAssign(string $id)
    {
        $paiements = Classe::FindOrFail($id);
        $Classe = Paiement::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => "L'assignation du paiements et de la classe  a ete creer avec succes Zone a ete success!!!!!.",
            'data' => $Classe,$paiements
        ]);
    }


    public function storeAssign(ClassePaiementStoreRequest $request)
    {

        try {

            // dd($request);
            $Classe = Classe::FindOrFail($request->classe_id);
            $paiements = Paiement::FindOrFail($request->paiement_id);
            $paiements->classes()->attach($Classe);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'La classe a ete assigner avec success!!!!!.',
                'data' => $paiements,
            ]);
        } catch (\Exception $e) {

            return response()->json($e);

        }

    }

    public function createDetach(string  $id)
    {
        $Classe = Classe::FindOrFail($id);
        $paiements = Paiement::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le detachement de la Zone a ete creer avec succes Zone a ete success!!!!!.',
            'data' => $paiements,$Classe
        ]);
    }


    public function showClassePaiement($id)
    {
        $unic_classe = ClassesPaiement::where('classe_id', $id)->get();

        if ($unic_classe->isEmpty()) {
            # code...
            return response()->json(['message' => "cet classe  n'a pas de paiement"], 404);
        }
        // jointures des $cantines_produits et produits pour avoir les produits d'une cantine donner
        $paiements = ClassesPaiement::join('classes', 'classes_paiements.classe_id', '=', 'classes.id')
            ->where('classe_id', $id)
            ->join('paiements', 'classes_paiements.paiement_id', '=', 'paiements.id')
            ->get();
        // dd($produits);
        if ($paiements->isEmpty()) {
            # code...
            return response()->json(['message' => "donner introuvable car la classe ou le paiement n'existe pas"]);
        }

        return ClassePaiementResource::collection($paiements);
    }



    public function storeDetach(ClassePaiementStoreRequest $request)
    {

        try {
            $Classe = Classe::FindOrFail($request->classe_id);
            $paiements = Paiement::FindOrFail($request->paiement_id);
            $paiements->classes()->detach($Classe);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $paiements
            ]);
        } catch (\Exception $e) {

            return response()->json($e);
        }

    }


    public function viewAttach()
    {


        try {
            //code...
            $Classepaiements = ClassePaiementResource::collection(ClassesPaiement::all());
            return $Classepaiements;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }



    public function viewAssign(string $id)
    {
        $paiements = Classe::FindOrFail($id);
        $Classe = Paiement::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => "L'assignation du paiements et de la classe  a ete creer avec succes Zone a ete success!!!!!.",
            'data' => $Classe,$paiements
        ]);
    }


    public function Assign(ElevePaiementStoreRequest $request)
    {

        try {

            $paiements = Paiement::FindOrFail($request->paiement_id);
            $eleves = Eleve::FindOrFail($request->eleve_id);
            // dd($paiements);
            $paiements->eleves()->attach($eleves,['montant_payer'=> $request->montant_payer,'date'=>$request->date,'tranche'=>$request->tranche]);



            return response()->json([
                'status_code' => 200,
                'status_message' => "L' a ete assigner avec success!!!!!.",
                'data' => $eleves,
            ]);
        } catch (\Exception $e) {
            // dd($e);

            return response()->json($e);

        }

    }

    public function viewDetach(string  $id)
    {
        $eleves = Eleve::FindOrFail($id);
        $paiements = Paiement::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le detachement de la Zone a ete creer avec succes Zone a ete success!!!!!.',
            'data' => $paiements,$eleves
        ]);
    }



    public function Detach(ElevePaiementStoreRequest $request)
    {


        try {
            $eleves = Eleve::FindOrFail($request->eleve_id);
            $paiements = Paiement::FindOrFail($request->paiements_id);
            $paiements->eleves()->detach($eleves,['montant_payer'=> $request->montant_payer,'date'=>$request->date,'tranche'=>$request->tranche]);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $eleves
            ]);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json($e);

        }

    }

    public function viewAttachEleve()
    {


        try {
            //code...
            $Elevepaiements = ElevePaiementResource::collection(ElevesPaiement::all());
            return $Elevepaiements;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

// Dans PostController



}
