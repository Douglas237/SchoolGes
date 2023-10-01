<?php

namespace App\Http\Controllers\Api;

use App\Models\Fichesante;
use App\Models\Infirmerie;
use App\Http\Controllers\Controller;

use App\Http\Resources\FichesanteResource;

use App\Http\Requests\StoreFichesanteRequest;
use App\Http\Requests\UpdateFichesanteRequest;

class FichesanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fichesante = Infirmerie::join('fichesantes', 'infirmeries.id', '=', 'fichesantes.infirmerie_id')->get();
        // dd($fichesante);
        return FichesanteResource::collection($fichesante);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFichesanteRequest $request)
    {
        //
        $infirmerie = Infirmerie::where('infirmeries.id', $request->infirmerie_id)->get();
        // $compte = CompteBank::where('numero_compte',$request->num_compte)->get();
        if ($infirmerie->isEmpty()) {
            # code...
            // throw new Exception("l'infirmerie n'existe pas", 1);
            return response()->json(["message"=>"l'infirmerie n'existe pas"]);
        }

        $addfichesanter = Fichesante::create($request->validated());

        return $addfichesanter ; 
    }

    /**
     * Display the specified resource.
     */
    public function show (Fichesante $fichesanter)
    {
        $onfichesanter = FichesanteResource::make($fichesanter);
        // dd($onfichesanter);
        return $onfichesanter;
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFichesanteRequest $request, Fichesante $fichesanter)
    {
        //
        $verif = Infirmerie::where('infirmeries.id', $request->infirmerie_id)->get();
        // InfirmerieResource::collection()
        // dd($verif);
        if ($verif->isEmpty()) {
            # code...
            return response()->json(["message"=>"l'infirmerie n'existe pas"]);
        }

        $fichesanter->update($request->validated());

        return FichesanteResource::make($fichesanter);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($fichesanter)
    {
        // verifie l'existance avant suppression
        $del = Fichesante::find($fichesanter);
        if (!$del) {
            # code...
            return response()->json(["message"=>"la fiche santer n'existe pas"]);
        }
        // suppression
        $del->delete();
        return response()->json(["message"=>"succes"]);
    }
}
