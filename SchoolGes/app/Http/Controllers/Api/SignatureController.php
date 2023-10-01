<?php

namespace App\Http\Controllers\Api;

use App\Models\Signature;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;
use App\Http\Resources\SignatureResource;
use App\Http\Requests\StoreSignatureRequest;
use App\Http\Requests\UpdateSignatureRequest;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allsignature = SignatureResource::collection(Signature::all());
        return $allsignature;
    }
    // afficher tous les cachet d'un etablissement
    public function onlysignature($id)
    {
        $etablissement_signature = Signature::where('etablissement_id', $id)->get();
        if ($etablissement_signature->isEmpty()) {
            # code...
            return response()->json([
                'message' => 'signature non trouvé pour cet etablissement'
            ], 404);
        }
        return SignatureResource::collection($etablissement_signature);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storesignature(StoreSignatureRequest $request)
    {
        //
        // $request->validated();
        $etablissement = Etablissement::find($request->etablissement_id);
        if (!$etablissement) {
            # code...
            return response()->json(['message' => 'Etablissement not found'], 404);
        }
        $signature = Signature::create($request->validated());
        return response()->json([
            "message" => "nouvelle signature",
            "data" => $signature
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($signature)
    {
        //
        $onesignature = Signature::find($signature);
        if (!$onesignature) {
            # code...
            return response()->json(['message' => 'Signature not found']);
        }
        return SignatureResource::make($onesignature);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatesignature(UpdateSignatureRequest $request, $signature)
    {
        //
        $verifsignature = Signature::find($signature);
        if (!$verifsignature) {
            # code...
            return response()->json(['message' => 'signature not found']);
        }
        $request->validated();
        $etablissement = Etablissement::find($request->etablissement_id);
        if (!$etablissement) {
            # code...
            return response()->json(['message' => 'Etablissement not found']);
        }
        $verifsignature->update($request->validated());
        return response()->json([
            "message" => "mise a jour de la signature",
            "data" => $verifsignature
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletesignature($signature)
    {
        $verifsignature = Signature::find($signature);
        if (!$verifsignature) {
            # code...
            return response()->json(['message' => 'Cachet not found']);
        }
        $verifsignature->delete();
        return response()->json([
            "message" => "suppression du cachet",
            "data" => $verifsignature
        ], 201);
    }
}
