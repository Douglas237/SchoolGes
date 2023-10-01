<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosteEleveStoreRequest;
use App\Models\PosteEleve;
use App\Models\Posteleves_SalleClasse;
use App\Http\Resources\PosteEleveResource;
use App\Models\SalleClasse;
use Illuminate\Http\Request;

class PosteEleveController extends Controller
{
    public function index()
    {
        //
        $PostEleve = PosteEleveResource::collection(PosteEleve::all());

        return $PostEleve;
    }

    /**
     * Store the product for a specifique cantine.
     */
    public function createAssign($id)
    {
        $salleClasse = SalleClasse::FindOrFail($id);
        $PostEleve = PosteEleve::all();

        return response()->json([
            "success" => true,
            "Message" =>'salles secondaires',
        ]);
    }


     public function store(PosteEleveStoreRequest $request)
     {
         //   dd($request);

         try {
             $PostEleve = new PosteEleve();
             $PostEleve->nom_poste = $request->nom_poste;
             $PostEleve->description = $request->description;
             $PostEleve->save();
             //Return Json Response
             return response()->json([
                 'status_code' => 200,
                 'status_message' => 'le PostEleve a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                 'data' => $PostEleve
             ]);
         } catch (\Exception $e) {
             //response json
             return response()->json($e);
         }
     }

    public function storepostEleve(PosteEleveStoreRequest $request)
    {
        $salleClasse = SalleClasse::FindOrFail($request->salleClasse)->Posteleves()->sync($request->PostEleve);
        // $PostEleve = PosteEleve::create($request->validated());
        // $salleClasse->Posteleves()->attach($PostEleve);

        return $salleClasse;
    }

    // afficher tous les poste_eleves pour une salle_classes specifique

    public function showallposteleves($id)
    {
        // tout les posteleves__salleclasses corespondants
        $posteleves__salleclasses = Posteleves_SalleClasse::where('id_salleclasse',$id)->get();

        if (!$posteleves__salleclasses) {
            # code...
            return response()->json(['message' => 'Aucune cantine pour cette id'], 404);
        }
        // jointures des $posteleves__salleclasses et produits pour avoir les poste_eleves d'une salle_classes donner
        $PostEleve = Posteleves_SalleClasse::join('salle_classes', 'posteleves__salleclasses.id_salleclasse', '=','salle_classes.id')
                                    ->where('id_salleclasse',$id)
                                    ->join('poste_eleves','posteleves__salleclasses.posteleve_id', '=', 'poste_eleves.id')
                                    ->get();
        // dd($produits);
        if ($PostEleve->isEmpty()) {
            # code...
            return response()->json(['message' => 'donner introuvable car la cantine ou le produit est inexistant']);
        }
        // $produit = Produit::all();

        return PosteEleveResource::collection($PostEleve);
    }

    // modiffier un produit pour une cantine donner

    public function updateUniquePosteleves(PosteEleveStoreRequest $request,SalleClasse $salleClasse,PosteEleve $PostEleve)
    {
        $PostEleve = Posteleves_SalleClasse::join('salle_classes', 'posteleves__salleclasses.id_salleclasse', '=','salle_classes.id')
                                    ->where('id_salleclasse',$salleClasse->id)
                                    ->join('poste_eleves','posteleves__salleclasses.posteleve_id', '=', 'poste_eleves.id')
                                    ->where('poste_eleves.id',$PostEleve->id)
                                    ->get();
        // on veriffie si le produit a update est parmis les produit de la cantine en question
        if ($PostEleve->isEmpty()) {
            # code...
            return response()->json(['message' => 'ce produit n.apartien pas a cette cantine']);
        }

        $PostEleve->update($request->validated());

        return PosteEleveResource::make($PostEleve);

    }

    // enlever un produit a une cantine donner
    public function removeUniquePosteleve(SalleClasse $salleClasse,PosteEleve $PostEleve)
    {
        $PostEleve = Posteleves_SalleClasse::join('salle_classes', 'posteleves__salleclasses.id_salleclasse', '=','salle_classes.id')
                                    ->where('id_salleclasse',$salleClasse->id)
                                    ->join('poste_eleves','posteleves__salleclasses.posteleve_id', '=', 'poste_eleves.id')
                                    ->where('poste_eleves.id',$PostEleve->id)
                                    ->get();
        // on veriffie si le produit a update est parmis les produit de la cantine en question
        if ($PostEleve->isEmpty()) {
            # code...
            return response()->json(['message' => "ce produit n'apartien pas a cette cantine"]);
        }
        $salleClasse->Posteleves()->detach($PostEleve);

        return PosteEleveResource::make($PostEleve);
    }
}
