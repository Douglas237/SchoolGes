<?php

namespace App\Http\Controllers\Api;

use App\Models\Cantine;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use App\Http\Resources\CantineResource;
use App\Http\Requests\StoreCantineRequest;
use App\Http\Requests\UpdateCantineRequest;
use App\Models\Etablissement;

class CantineController extends Controller
{
    // ici on n'utilise pas les ressources

    // renvoyer les cantines
    public function index()
    {
        // $cantine = Cantine::all();
        try {
            //code...
            $cantine = CantineResource::collection(Cantine::all());
            return $cantine;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e); 
        }
    }

    // renvoyer une cantine stpecifique
    public function show(Cantine $cantine)
    {
        try {
            //code...
            $onecantine = CantineResource::make($cantine);

            return $onecantine;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }
    // enregistrer une cantine
    public function store (StoreCantineRequest $request)
    {
        try {
            //code...
            $etablissement = Etablissement::find($request->etablissement_id);
            if (!$etablissement) {
                # code...
                return response()->json(["message" => "etablissement n'existe pas "]);
            }
            $newcantine = Cantine::create($request->validated());
            return $newcantine;
        } catch (\Throwable $e) {
            //throw $th;
            return response()->json($e);
        }

    }
    // mettre jour une infirmerie
    public function update(UpdateCantineRequest $request, Cantine $cantine)
    {
        try {
            //code...
            $etablissement = Etablissement::find($request->etablissement_id);
            if (!$etablissement) {
                # code...
                return response()->json(["message" => "etablissement n'existe pas "]);
            }
            $cantine->update($request->validated());
            return $cantine;
        } catch (\Throwable $e) {
            //throw $th;
            return response()->json($e);
        }
    }
    public function delete(Cantine $cantine)
    {
        try {
            //code...
            $cantine -> delete();

            return response()->json(["message"=>"cantine suprimer avec succes"]);
        } catch (\Throwable $e) {
            //throw $th;
            return response()->json($e);
        }
    }
}
