<?php

namespace App\Http\Controllers\Api;

use App\Models\Infirmerie;
use App\Http\Controllers\Controller;
use App\Http\Resources\InfirmerieResource;
use App\Http\Requests\StoreInfirmerieRequest;
use App\Http\Requests\UpdateInfirmerieRequest;

class InfirmerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
            $infirmerie = InfirmerieResource:: collection(Infirmerie::all());
            return $infirmerie ;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreInfirmerieRequest $request)
    {
        try {
            //code...
            $new_infirmerie = Infirmerie::create($request->validated());

            return $new_infirmerie;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e); 
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Infirmerie $infirmerie)
    {
        //
        try {
            //code...
            return InfirmerieResource::make($infirmerie);
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
        // return Infirmerie::find($infirmerie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfirmerieRequest $request, Infirmerie $infirmerie)
    {
        //
        try {
            //code...
            $infirmerie->update($request->validated());

            return InfirmerieResource::make($infirmerie);
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infirmerie $infirmerie)
    {
        //
        try {
            //code...
            $infirmerie -> delete();

            return response()->json(["message"=>"succes"]);
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }
}
