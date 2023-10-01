<?php

namespace App\Http\Controllers\Api;

use App\Models\Materieldidactique;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaterieldidactiqueRequest;
use App\Http\Requests\UpdateMaterieldidactiqueRequest;
use App\Http\Resources\MaterieldidactiqueResource;

class MaterieldidactiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
            // return Materieldidactique::all();
            $materieldidactique = MaterieldidactiqueResource::collection(Materieldidactique::all());

            return $materieldidactique;

        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterieldidactiqueRequest $request)
    {
        try {
            //code...
            $addmaterieldidactique = Materieldidactique::create($request->validated());
    
            return $addmaterieldidactique ;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Materieldidactique $materieldidactique)
    {
        try {
            //code...
            $onematerieldidactique = MaterieldidactiqueResource::make($materieldidactique);
    
            return $onematerieldidactique;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterieldidactiqueRequest $request, Materieldidactique $materieldidactique)
    {
        try {
            //code...
            $materieldidactique->update($request->validated());
    
            return MaterieldidactiqueResource::make($materieldidactique);
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materieldidactique $materieldidactique)
    {
        try {
            //code...
            $materieldidactique -> delete();
    
            return response()->json(["message"=>"materiel didactique supprimer avec succes"]);
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }
}
