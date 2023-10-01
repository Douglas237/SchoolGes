<?php

namespace App\Http\Controllers\Api;

use App\Models\Cachet;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCachetRequest;
use App\Http\Requests\UpdateCachetRequest;
use App\Http\Resources\CachetResource;
use App\Models\Etablissement;

class CachetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcachet = CachetResource::collection(Cachet::all());
        return $allcachet;
    }
// afficher tous les cachet d'un etablissement
    public function onlycachet($id)
    {
        $etablissement_cachet = Cachet::where('etablissement_id', $id)->get();
        if ($etablissement_cachet->isEmpty()) {
            # code...
            return response()->json([
                'message' => 'Cachet non trouvé pour cet etablissement'
            ], 404);
        }
        return CachetResource::collection($etablissement_cachet);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeCachet(StoreCachetRequest $request)
    {
        //
        // $request->validated();
        $etablissement = Etablissement::find($request->etablissement_id);
        if (!$etablissement) {
            # code...
            return response()->json(['message' => 'Etablissement not found'], 404);
        }
        $cachet = Cachet::create($request->validated());
        return response()->json([
            "message" => "nouveau cachet",
            "data" => $cachet
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($cachet)
    {
        //
        $onecachet = Cachet::find($cachet);
        if (!$onecachet) {
            # code...
            return response()->json(['message' => 'Cachet not found']);
        }
        return CachetResource::make($onecachet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatecachet(UpdateCachetRequest $request, $cachet)
    {
        //
        $verifcachet = Cachet::find($cachet);
        if (!$verifcachet) {
            # code...
            return response()->json(['message' => 'Cachet not found']);
        }
        $request->validated();
        $etablissement = Etablissement::find($request->etablissement_id);
        if (!$etablissement) {
            # code...
            return response()->json(['message' => 'Etablissement not found']);
        }
        $verifcachet->update($request->validated());
        return response()->json([
            "message" => "mise a jour du cachet",
            "data" => $verifcachet
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletecachet($cachet)
    {
        $verifcachet = Cachet::find($cachet);
        if (!$verifcachet) {
            # code...
            return response()->json(['message' => 'Cachet not found']);
        }
        $verifcachet->delete();
        return response()->json([
            "message" => "suppression du cachet",
            "data" => $verifcachet
        ], 201);
    }
}
