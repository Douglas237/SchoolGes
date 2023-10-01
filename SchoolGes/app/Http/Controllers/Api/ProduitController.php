<?php

namespace App\Http\Controllers\Api;

use App\Models\Produit;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Http\Resources\ProduitResource;
use App\Models\Cantine;
use App\Models\Cantines_produit;
use GuzzleHttp\Psr7\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produit = ProduitResource::collection(Produit::all());

        return $produit;
    }

    /**
     * Store the product for a specifique cantine.
     */
    public function storeproduct(StoreProduitRequest $request, $id)
    {
        $cantine = Cantine::find($id);
        $produit = Produit::create($request->validated());
        $cantine->produits()->attach($produit);

        return $produit;
    }

    // afficher tous les produits pour un comercant specifique

    public function showallproduct($id)
    {
        // tout les cantines_produits corespondants
        $cantines_produits = Cantines_produit::where('cantine_id',$id)->get();

        if (!$cantines_produits) {
            # code...
            return response()->json(['message' => 'Aucune cantine pour cette id'], 404);
        }
        // jointures des $cantines_produits et produits pour avoir les produits d'une cantine donner
        $produits = Cantines_produit::join('cantines', 'cantines_produits.cantine_id', '=','cantines.id')
                                    ->where('cantine_id',$id)
                                    ->join('produits','cantines_produits.produit_id', '=', 'produits.id')
                                    ->get();
        // dd($produits);
        if ($produits->isEmpty()) {
            # code...
            return response()->json(['message' => 'donner introuvable car la cantine ou le produit est inexistant']);
        }
        // $produit = Produit::all();

        return ProduitResource::collection($produits);
    }

    // modiffier un produit pour une cantine donner

    public function updateUniqueProduct(UpdateProduitRequest $request,Cantine $cantine,Produit $produit)
    {
        $produits = Cantines_produit::join('cantines', 'cantines_produits.cantine_id', '=','cantines.id')
                                    ->where('cantine_id',$cantine->id)
                                    ->join('produits','cantines_produits.produit_id', '=', 'produits.id')
                                    ->where('produits.id',$produit->id)
                                    ->get();
        // on veriffie si le produit a update est parmis les produit de la cantine en question
        if ($produits->isEmpty()) {
            # code...
            return response()->json(['message' => 'ce produit n.apartien pas a cette cantine']);
        }

        $produit->update($request->validated());

        return ProduitResource::make($produit);

    }

    // enlever un produit a une cantine donner
    public function removeUniqueProduct(Cantine $cantine,Produit $produit)
    {
        $produits = Cantines_produit::join('cantines', 'cantines_produits.cantine_id', '=','cantines.id')
                                    ->where('cantine_id',$cantine->id)
                                    ->join('produits','cantines_produits.produit_id', '=', 'produits.id')
                                    ->where('produits.id',$produit->id)
                                    ->get();
        // on veriffie si le produit a update est parmis les produit de la cantine en question
        if ($produits->isEmpty()) {
            # code...
            return response()->json(['message' => "ce produit n'apartien pas a cette cantine"]);
        }
        $cantine->produits()->detach($produit);

        return ProduitResource::make($produit);
    }

}
