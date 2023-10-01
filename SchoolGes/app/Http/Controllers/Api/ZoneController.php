<?php

namespace App\Http\Controllers\Api;

use App\Models\Bus;
use App\Models\Zone;
use App\Models\BusZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ZoneStoreRequest;
use App\Http\Resources\BusZonesResource;
use App\Http\Requests\BusZonesStoreRequest;

class ZoneController extends Controller
{


    public function index()
    {
        //All Bus
        $Zone = Zone::all();
        // Return Json Response

        return response()->json([
            'Zone' => $Zone
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
    public function store(ZoneStoreRequest $request)
    {
        //   dd($request);

        try {
            $zone = new Zone();
            $zone->nom_zone = $request->nom_zone;
            $zone->description = $request->description;
            $zone->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'la Zone a ete Ajoute avec success!!!!!.',
                'data' => $zone
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
        $zone = Zone::find($id);
        if (!$zone) {
            return response()->json([
                'message' => 'zone Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'zone' => $zone
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Classe details
        $zone = Zone::find($id);
        if (!$zone) {
            return response()->json([
                'message' => 'zone Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'zone' => $zone
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ZoneStoreRequest $request,  Zone $zone)
    {
        // dd($zone);
        try {
            // Update Zone

            $zone->nom_zone = $request->nom_zone;
            $zone->description = $request->description;
            $zone->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'la Zone a ete Modifier avec success!!!!!.',
                'data' => $zone
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Zone $zone)
    {


        try {
            if ($zone) {
                $zone->delete();
                //Return Json Response
                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'La Zone a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
                    'data' => $zone
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Enregistrement introuvable😢😢😢😢.',
                    'data' => $zone
                ]);
            }
        } catch (\Exception $e) {
            //response json
            return response()->json($e);
        }
    }



    public function createAssign(string $id)
    {
        $unic_zones = BusZone::where('zones_id', $id)->get();

        if ($unic_zones->isEmpty()) {
            # code...
            return response()->json(['message' => "cet zones  n'a pas de bus"], 404);
        }
        // jointures des $cantines_produits et produits pour avoir les produits d'une cantine donner
        $Bus = BusZone::join('zones', 'bus_zones.zones_id', '=', 'zones.id')
            ->where('zones_id', $id)
            ->join('buses', 'bus_zones.bus_id', '=', 'buses.id')
            ->get();
        // dd($produits);
        if ($Bus->isEmpty()) {
            # code...
            return response()->json(['message' => "donner introuvable car la zones ou le bus n'existe pas"]);
        }

        return BusZonesResource::collection($Bus);
    }


    public function storeAssign(BusZonesStoreRequest $request)
    {

        try {

            // dd($request);
            $Bus = Bus::FindOrFail($request->bus_id);
            $zones = Zone::FindOrFail($request->zones_id);
            $zones->bus()->attach($Bus);



            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le/Les bus a/ont ete assigner avec success!!!!!.',
                'data' => $zones,
            ]);
        } catch (\Exception $e) {

            return response()->json($e);

        }

    }

   public function createDetach(string  $id)
    {
        $unic_zones = BusZone::where('zones_id', $id)->get();

        if ($unic_zones->isEmpty()) {
            # code...
            return response()->json(['message' => "cet zones  n'a pas de bus"], 404);
        }
        $Bus = BusZone::join('zones', 'bus_zones.zones_id', '=', 'zones.id')
            ->where('zones_id', $id)
            ->join('buses', 'bus_zones.bus_id', '=', 'buses.id')
            ->get();
        if ($Bus->isEmpty()) {
            # code...
            return response()->json(['message' => "donner introuvable car la zones ou le bus n'existe pas"]);
        }

        return BusZonesResource::collection($Bus);
    }



    public function storeDetach(BusZonesStoreRequest $request, $id)
    {


        try {
            $Bus = Bus::FindOrFail($request->bus_id);
            $zones = Zone::FindOrFail($request->zones_id);
            $zones->bus()->detach($Bus);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $zones
            ]);
        } catch (\Exception $e) {

            return response()->json($e);
        }

    }





}
