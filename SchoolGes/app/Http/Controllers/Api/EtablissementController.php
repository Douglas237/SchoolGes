<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;
use App\Http\Resources\EtablissementResource;
use App\Http\Requests\StoreEtablissementRequest;
use App\Http\Requests\UpdateEtablissementRequest;
use App\Models\Sequence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Storage;

class EtablissementController extends Controller
{
    // ici on n'utilise pas les ressources

    public function index()
    {
        $id = Auth::guard('chef_etablissement')->user()->id;
        $etablissement = Etablissement::where('chefetablissement_id', $id)->get();
        // $etablissement = EtablissementResource::collection(Etablissement::all());
        return EtablissementResource::collection($etablissement);
    }

    // renvoyer un etablissement stpecifique
    public function show(Etablissement $etablissement)
    {
        $oneetablissement = EtablissementResource::make($etablissement);

        return $oneetablissement;
    }
    // enregistrer un etablissement
    public function store (StoreEtablissementRequest $request)
    {
        // dd($request);
        $id = Auth::guard('admins_circonscription')->user()->id;
        // return $id;
        try {
            $nom = str_replace(' ', '', $request->nom);
            $imageName = trim($nom) . "." . $request->logo->getClientOriginalExtension();
            $newetablissement = Etablissement::create([
                "nom" => $request->nom,
                "description" => $request->description,
                "admincirconscription_id" => $id,
                "chefetablissement_id" => $request->chefetablissement_id,
                "adress_postal" => $request->adress_postal,
                "abreviation_nom" => $request->abreviation_nom,
                "devise" => $request->devise,
                "logo" => $imageName,
                "adresse_email" => $request->adresse_email,
                "telephone" => $request->telephone,
                "siege_sociale" => $request->siege_sociale,
            ]);
            // dd($newetablissement);
            Storage::disk('etablissements')->put($imageName, file_get_contents($request->logo));
            return $newetablissement;
        } catch (\Throwable $e) {
            //throw $th;
            return response()->json($e);
        }

    }
    // mettre a jour un etablissement
    public function update(UpdateEtablissementRequest $request, Etablissement $etablissement)
    {
        try {
            //code...
            $etablissement->update($request->validated());
            return $etablissement;
        } catch (\Throwable $e) {
            //throw $th;
            return response()->json($e);
        }
    }
    // supprimerun etablissement
    public function delete(Etablissement $etablissement)
    {
        try {
            //code...
            $etablissement -> delete();

            return response()->json(["message"=>"etablissement suprimer avec succes"]);
        } catch (\Throwable $e) {
            //throw $th;
            return response()->json($e);
        }
    }



    public function storeAssign(StoreEtablissementRequest $request, $id)
    {

        try {

            // dd($request);
            // $zones = Zone::find(6);
            $sequences = Sequence::find($id);
            $etablissement = Etablissement::create($request->validated());
            // $zones = Zone::create($request->validated());

            // $bus->zones()->attach($zones);
            // dd($zones);
            // dd($bus);
            $sequences->etablissements()->attach($etablissement);

            // $bus = Zone::FindOrFail($id)->zones()->sync(['bus_id']);
            // $bus->bus = $request->bus;
            // $bus->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La Zone a ete assigner avec success!!!!!.',
                'data' => $sequences
            ]);
        } catch (\Exception $e) {
            // dd($e);
            // Toastr::error("Echec d'Assignation");
            return response()->json($e);

        }
                   //response json
                //    return response()->json($e);
    }






    public function storeDetach(StoreEtablissementRequest $request, $id)
    {


        try {
            $etablissement = Etablissement::find($id);
            $sequences = Sequence::FindOrFail($id)->etablissements()->detach($etablissement);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $etablissement
            ]);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json($e);

        }
        // return redirect()->back();
    }

}
