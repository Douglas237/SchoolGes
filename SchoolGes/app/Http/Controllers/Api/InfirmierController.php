<?php

namespace App\Http\Controllers\Api;

use App\Models\Infirmier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfirmierRequest;
use App\Http\Requests\UpdateInfirmierRequest;
use App\Http\Resources\InfirmierResource;
use App\Models\Infirmerie;

class InfirmierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infirmier =InfirmierResource::collection(Infirmier::all());

        return $infirmier;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfirmierRequest $request)
    {
        $infirmerie = Infirmerie::where('infirmeries.id', $request->infirmerie_id)->get();
        // $compte = CompteBank::where('numero_compte',$request->num_compte)->get();
        if ($infirmerie->isEmpty()) {
            # code...
            // throw new Exception("l'infirmerie n'existe pas", 1);
            return response()->json(["message"=>"l'infirmerie n'existe pas"]);
        }

        $addfichesanter = Infirmier::create($request->validated());

        return $addfichesanter ;
    }

    /**
     * Display the specified resource.
     */
    public function show ($infirmier)
    {
        $oninfirmier = Infirmier::find($infirmier);
        if (!$oninfirmier) {
            # code...
            return response()->json(["message"=>"l'infirmerie n'existe pas"]);
        }
        // dd($onfichesanter);
        return $oninfirmier;
    }

    public function showall(Infirmerie $infirmerie)
    {
        $allinfirmier = Infirmier::where('infirmerie_id', $infirmerie->id)->get();

        if ($allinfirmier->isEmpty()) {
            # code...
            return response()->json(["message" => "il n'y a pas d'infirmier pour cette infirmerie "]);
        }
        return InfirmierResource::collection($allinfirmier);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infirmier $infirmier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfirmierRequest $request, Infirmier $infirmier)
    {
        //
        $infirmiertest = InfirmierResource::make($infirmier);
        if (!$infirmiertest) {
            # code...
            return response()->json(["message"=>"l'infirmier n'existe pas"]);
        }
        $verif = Infirmerie::where('infirmeries.id', $request->infirmerie_id)->get();
        // InfirmerieResource::collection()
        // dd($verif);
        if ($verif->isEmpty()) {
            # code...
            return response()->json(["message"=>"l'infirmerie n'existe pas"]);
        }

        $infirmier->update($request->validated());

        return InfirmierResource::make($infirmier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($infirmier)
    {
        //
        $del = Infirmier::find($infirmier);
        if (!$del) {
            # code...
            return response()->json(["message"=>"l'infirmier n'existe pas"]);
        }
        // suppression
        $del->delete();
        return response()->json(["message"=>"succes"]);
    }
}
