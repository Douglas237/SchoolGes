<?php

namespace App\Http\Controllers\Api;

use App\Models\Poste;
use App\Models\SalleClasse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PosteResource;
use App\Http\Requests\StorePosteRequest;
use App\Http\Requests\UpdatePosteRequest;
use App\Http\Requests\PosteSalleClasseStoreRequest;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postes = Poste::all();

        return $postes;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePosteRequest $request)
    {
        //
        $newposte = Poste::create($request->validated());

        return PosteResource::make($newposte);
    }

    /**
     * Display the specified resource.
     */
    public function show($poste)
    {
        //
        $posteverif = Poste::find($poste);
        if (!$posteverif) {
            # code...
            return response()->json([
              'message' => 'poste not found'
            ], 404);
        }
        return PosteResource::make($posteverif);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePosteRequest $request, $poste)
    {
        $verifposte = Poste::find($poste);
        if (!$verifposte) {
            # code...
            return response()->json([
             'message' => 'poste not found'
            ], 404);
        }
        $verifposte->update($request->validated());
        return PosteResource::make($verifposte);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($poste)
    {
        $verifposte = Poste::find($poste);
        if (!$verifposte) {
            # code...
            return response()->json([
             'message' => 'poste not found'
            ], 404);
        }
        $verifposte->delete();
        return response()->json([
            "message" => "suprimer avec succes",
            "data" => PosteResource::make($verifposte)
        ], 200);
    }


    public function createAssign(string $id)
    {
        $SalleClasse = SalleClasse::FindOrFail($id);
        $postes = Poste::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => "L'assignation du poste et de la salleclasse  ont ete creer avec succes Zone a ete success!!!!!.",
            'data' => $SalleClasse,$postes
        ]);
    }


    public function storeAssign(PosteSalleClasseStoreRequest $request)
    {

        try {

            // dd($request);
            $SalleClasse = SalleClasse::FindOrFail($request->salleclaasse_id);
            $postes = Poste::FindOrFail($request->poste_id);
            $postes->salleClasses()->attach($SalleClasse);

            // $paiements = Paiement::FindOrFail($request->paiements)->classes()->sync($request->Classe);
            // $bus = Bus::find($id);


            // $bus->zones()->attach($zones);
            // $user = User::find($userId);
            // $role = Role::find($roleId);

            // $user->roles()->attach($role);







            return response()->json([
                'status_code' => 200,
                'status_message' => 'La salleclasse et le poste ont ete assigner avec success!!!!!.',
                'data' => $postes,
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
        $SalleClasse = SalleClasse::FindOrFail($id);
        $postes = Poste::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Le detachement de la salle de classe et du poste ont ete creer avec succes Zone a ete success!!!!!.',
            'data' => $SalleClasse,$postes
        ]);
    }



    public function storeDetach(PosteSalleClasseStoreRequest $request)
    {


        try {
            $SalleClasse = SalleClasse::FindOrFail($request->salleclaasse_id);
            $postes = Poste::FindOrFail($request->poste_id);
            $postes->salleClasses()->detach($SalleClasse);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $postes
            ]);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json($e);

        }
        // return redirect()->back();
    }

}
