<?php

namespace App\Http\Controllers\Api;

use App\Models\Bus;
use App\Models\Eleve;
use App\Models\BusEleve;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusStoreRequest;
use App\Http\Resources\BusEleveResource;
use App\Http\Requests\BusEleveStoreRequest;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //All Bus
        $Bus = Bus::all();
        // Return Json Response

        return response()->json([
            'Bus' => $Bus
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
    public function store(BusStoreRequest $request)
    {
        // dd($request);

        try {
            // $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
            //create Bus
            Bus::create([
                'nom_bus' => $request->nom_bus,
                'capaciter' => $request->capaciter,
                'chauffeur' => $request->chauffeur,
                // 'image' => $imageName,
                'description' => $request->description,
            ]);
            //ave image in storage folder
            // Storage::disk('public')->put($imageName, file_get_contents($request->image));

            //Return Json Response
            return response()->json([
                'message' => 'Bus successfully created.'
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
        //Bus details
        $Bus = Bus::find($id);
        if (!$Bus) {
            return response()->json([
                'message' => 'Bus Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'Bus' => $Bus
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Bus details
        $Bus = Bus::find($id);
        if (!$Bus) {
            return response()->json([
                'message' => 'Bus Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'Bus' => $Bus
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusStoreRequest $request, $id)
    {
        try {
            //Find Bus
            $Bus = Bus::find($id);
            if (!$Bus) {
                return response()->json([
                    'mesage' => 'Bus Not Found'
                ], 404);
            }
            $Bus->nom_bus = $request->nom_bus;
            $Bus->capaciter = $request->capaciter;
            $Bus->chauffeur = $request->chauffeur;
            $Bus->description = $request->description;


            //update Bus

            $Bus->save();

            //return json response

            return response()->json([
                'message' => 'Bus Successfully Updated.'
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
        $Bus = Bus::find($id);
        if (!$Bus) {
            return response()->json([
                'message' => 'Bus Not Found.'
            ], 404);
        }



        //Delete Bus
        $Bus->delete();

        //Return Json Response
        return response()->json([
            'message' => 'Bus successfully deleted'
        ], 200);
    }


    public function createAssign(string $id)
    {
        $eleve = Eleve::FindOrFail($id);
        $Bus = Bus::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => "L'assignation de l'eleve et du bus ont ete creer avec  success!!!!!.",
            'data' => $eleve,$Bus
        ]);
    }


    public function storeAssign(BusEleveStoreRequest $request)
    {

        try {

            // dd($request);
            $eleve = Eleve::FindOrFail($request->eleve_id);
            $Bus = Bus::FindOrFail($request->bus_id);
            $Bus->eleves()->attach($eleve);

            // $paiements = Paiement::FindOrFail($request->paiements)->classes()->sync($request->Classe);
            // $bus = Bus::find($id);


            // $bus->zones()->attach($zones);
            // $user = User::find($userId);
            // $role = Role::find($roleId);

            // $user->roles()->attach($role);







            return response()->json([
                'status_code' => 200,
                'status_message' => 'La classe a ete assigner avec success!!!!!.',
                'data' => $Bus,
            ]);
        } catch (\Exception $e) {
            // dd($e);
            // Toastr::error("Echec d'Assignation");
            return response()->json($e);

        }
                   //response json
                //    return response()->json($e);
    }

    public function createDetach(string  $id)
    {
        $eleve = Eleve::FindOrFail($id);
        $Bus = Bus::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => "Le detachement de l'eleve et du bus ont ete creer avec  success!!!!!.",
            'data' => $eleve,$Bus
        ]);
    }



    public function storeDetach(BusEleveStoreRequest $request)
    {


        try {
            $eleve = Eleve::FindOrFail($request->eleve_id);
            $Bus = Bus::FindOrFail($request->bus_id);
            $Bus->eleves()->detach($eleve);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $eleve
            ]);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json($e);

        }
        // return redirect()->back();
    }

    public function viewAttach()
    {


        try {
            //code...
            $Classepaiements = BusEleveResource::collection(BusEleve::all());
            return $Classepaiements;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

}
