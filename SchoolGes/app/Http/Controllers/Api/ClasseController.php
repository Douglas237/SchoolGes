<?php

namespace App\Http\Controllers\Api;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\LivreProgramme;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseStoreRequest;
use App\Http\Requests\LivresProgrammeStoreRequest;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //All Bus
        $Classe = Classe::all();
        // Return Json Response

        return response()->json([
            'Classe' => $Classe
        ], 200);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasseStoreRequest $request)
    {
        //   dd($request);

        try {
            // $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
            //create Classe
            Classe::create([
                'nom_classe' => $request->nom_classe,
                // 'image' => $imageName,
                'description' => $request->description,
                'code_classe' => $request->code_classe,
                'classesyst_id' => $request->classesyst_id,
                'etablissement_id' => $request->etablissement_id,
            ]);
            //ave image in storage folder
            // Storage::disk('public')->put($imageName, file_get_contents($request->image));

            //Return Json Response
            return response()->json([
                'message' => 'Classe successfully created.'
            ], 200);
        } catch (\Exception $e) {
            //response json
            return response()->json([
                'message' => 'something went really wrong!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Classe details
        $Classe = Classe::find($id);
        if (!$Classe) {
            return response()->json([
                'message' => 'Classe Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'Classe' => $Classe
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $Classe = Classe::find($id);
        if (!$Classe) {
            return response()->json([
                'message' => 'Classe Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'Classe' => $Classe
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClasseStoreRequest $request,  $id)
    {
        try {
            //Find Classe
            $Classe = Classe::find($id);
            if (!$Classe) {
                return response()->json([
                    'mesage' => 'Classe Not Found'
                ], 404);
            }
            $Classe->nom_classe = $request->nom_classe;
            $Classe->description = $request->description;
            $Classe->code_classe = $request->code_classe;
            $Classe->classesyst_id = $request->classesyst_id;
            $Classe->etablissement_id = $request->etablissement_id;

            //update Classe

            $Classe->save();

            //return json response

            return response()->json([
                'message' => 'Classe Successfully Updated.'
            ], 200);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Detail
        $Classe = Classe::find($id);
        if (!$Classe) {
            return response()->json([
                'message' => 'Classe Not Found.'
            ], 404);
        }



        //Delete Classe
        $Classe->delete();

        //Return Json Response
        return response()->json([
            'message' => 'Classe successfully deleted'
        ], 200);
    }


    public function storeAssign(ClasseStoreRequest $request, $id)
    {

        try {

            // dd($request);
            // $zones = Zone::find(6);
            $livreprogrammes = LivreProgramme::find($id);
            $classe = Classe::create($request->validated());
            // $zones = Zone::create($request->validated());

            // $bus->zones()->attach($zones);
            // dd($zones);
            // dd($bus);
            $classe->livresProgrammes()->attach($livreprogrammes);

            // $bus = Zone::FindOrFail($id)->zones()->sync(['bus_id']);
            // $bus->bus = $request->bus;
            // $bus->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le Livre a ete assigner avec success!!!!!.',
                'data' => $livreprogrammes
            ]);
        } catch (\Exception $e) {
            // dd($e);
            // Toastr::error("Echec d'Assignation");
            return response()->json($e);
        }
        //response json
        //    return response()->json($e);
    }

    public function storeDetach(ClasseStoreRequest $request, $id)
    {


        try {
            $livreprogrammes = LivreProgramme::find($id);
            $classe = LivreProgramme::FindOrFail($id)->livresProgrammes()->detach($livreprogrammes);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $livreprogrammes
            ]);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json($e);
        }
        // return redirect()->back();
    }
}
