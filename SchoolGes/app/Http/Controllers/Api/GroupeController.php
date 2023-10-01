<?php

namespace App\Http\Controllers\Api;

use App\Models\Groupe;
use App\Models\SalleBase;
use Illuminate\Http\Request;
use App\Models\SalleSecondaire;
use App\Http\Controllers\Controller;
use App\Http\Requests\ElevegroupeStoreRequest;
use App\Models\Eleve;
use App\Models\ElevesGroupe;
use Illuminate\Support\Facades\Validator;

class GroupeController extends Controller
{
    public function index()
    {

        $groupe = Groupe::all();
        $slb = SalleBase::find($groupe);

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Succes🤩🤩😍.',
            'data' =>$slb,$groupe
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_salle_base' => 'required',
            // 'id_salle_secondaire' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {
            $groupe = new Groupe();

            $groupe->id_salle_base  = $request->id_salle_base ;
            // $groupe->id_salle_secondaire  = $request->id_salle_secondaire ;
            $groupe->description = $request->description;
            $groupe->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Succes🤩🤩😍.',
                'data' => $groupe
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'mesage' => 'Echec de votre operation'
            ], 500);
        }
    }

    public function show($id)
    {
        $groupe = SalleBase::find($id);
        // $sls = SalleSecondaire::find($id);
        if ($groupe != null )  {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $groupe
            ]);
        }
        return response()->json([
            'message' => 'Tranche Not Found.'
        ], 404);
    }

    public function edit($id)
    {
        $groupe = SalleBase::find($id);
        // $sls = SalleSecondaire::find($id);
        if ($groupe != null)  {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $groupe
            ]);
        }
        return response()->json([
            'message' => 'Groupe Not Found.'
        ], 404);
    }

    public function update(Request $request,$id)
    {
        try {
            $groupe = SalleBase::find($id);
            // $sls = SalleSecondaire::find($request->id);
            // $res = $groupe.'+'.$sls;
            if ($groupe == null) {
                return response()->json([
                    'message' =>'salle base not found!'
                ]);
            }
            $groupe->id_salle_base  = $request->id_salle_base ;
            // $groupe->id_salle_secondaire  = $request->id_salle_secondaire ;
            $groupe->description = $request->description;
            $groupe->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification de Etablissement Secondaire effectuer avec success😎😎.',
                'data' => $groupe
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }
    public function delete($id)
    {
        $groupe  = Groupe::find($id)->delete();
        if (!$groupe) {
            return response()->json([
                'message' => 'billet Not Found.'
            ], 404);
        }
        $groupe->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'La billet a ete Supprimer avec success🤣🤣🤣🤣🤣!!!!!.',
            'data' => $groupe
        ]);
    }

    public function createAssign(string $id)
    {
        $groupes = Groupe::FindOrFail($id);
        $eleves = Eleve::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => "L'assignation a ete creer avec  succes!!!!!.",
            'data' => $groupes,$eleves
        ]);
    }


    public function storeAssign(ElevegroupeStoreRequest $request)
    {

        try {

            // dd($request);
            $eleves = Eleve::FindOrFail($request->eleve_id);
            $groupes = Groupe::FindOrFail($request->groupe_id);
            $groupes->eleves()->attach($eleves);

            // $paiements = Paiement::FindOrFail($request->paiements)->classes()->sync($request->Classe);
            // $bus = Bus::find($id);


            // $bus->zones()->attach($zones);
            // $user = User::find($userId);
            // $role = Role::find($roleId);

            // $user->roles()->attach($role);







            return response()->json([
                'status_code' => 200,
                'status_message' => 'Les eleves ont  ete assigner a leurs groupes  avec success!!!!!.',
                'data' => $groupes,
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
        $groupes = Groupe::FindOrFail($id);
        $eleves = Eleve::all();
        return response()->json([
            'status_code' => 200,
            'status_message' => "Le detachement a ete creer avec  succes !!!!!.",
            'data' => $groupes,$eleves
        ]);
    }



    public function storeDetach(ElevegroupeStoreRequest $request)
    {


        try {
            $eleves = Eleve::FindOrFail($request->eleve_id);
            $groupes = Groupe::FindOrFail($request->groupe_id);
            $groupes->eleves()->detach($eleves);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Les eleves ont ete detacher de leurs groupes avec succes !!!!!.',
                'data' => $groupes
            ]);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json($e);

        }
        // return redirect()->back();
    }


    public function viewAttach()
    {
        //All Bus
        $elevesGroupes = ElevesGroupe::all();
        // Return Json Response

        return response()->json([
            'paiements' => $elevesGroupes
        ], 200);
    }
}
