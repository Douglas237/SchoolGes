<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Ressource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\updateRessourceRequest;
use App\Models\Atelier;
use App\Models\AtelierRessource;

class RessourcesController extends Controller
{
    // liste des ressources
    public function index()
    {
        $ressource = Ressource::all();
        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des ressources',
            'data' => $ressource
        ]);
    }

    //creation d'une ressource

    public function store(StoreRessourceRequest  $request)
    {

        try {
            $atelier = Atelier::all();
            $ressource = Ressource::create($request->validated());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Ressource ajouté',
                'data' => $ressource
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //ressources d'un atelier pour un etablissement
    public function ressource($id)
    {
        try {
            if ($id) {
                $ressource = Ressource::where('ressources.atelier_id', $id)->get();

                if ($ressource->isEmpty()) {
                    return response()->json(["status_message" => "Aucune ressources pour cet atelier"]);
                }
                return response()->json([
                    'status_message' => 'les ressources de cet atelier',
                    'data' => $ressource
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'ressources non existante'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
    // modification d'une ressource
    public function update(updateRessourceRequest $request, $id)
    {
        try {

            $ressource = Ressource::find($id);
            $ressource->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Ressource modifier',
                'data' => $ressource
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer une ressource
    public  function destroy($id)
    {
        try {
            if ($id) {
                $ressource = Ressource::find($id);
                $ressource->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'Ressource supprimer',
                    'data' => $ressource
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Ressource introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'une ressource
    public function show($id)
    {
        try {
            if ($id) {
                $ressource = Ressource::find($id);
                return response()->json([
                    'status_message' => 'detail ressource',
                    'data' => $ressource
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'ressource non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //retirer une ressource a un atelier

    //    public function detacheressources(Atelier $atelier,Ressource $ressource)
    //    {
    //     $ressource = AtelierRessource::join('ateliers','atelier_ressources.atelier_id','=','ateliers.id')
    //     ->where('atelier_id',$atelier->id)
    //     ->join('ressources','atelier_ressources.ressource_id','=','ressources.id')
    //     ->where('ressources.id',$ressource->id)
    //     ->get();
    //     if($ressource->isEmpty())
    //     {
    //         return response()->json(['status_message' => 'cette ressource ne correspond pas à cet atelier']);
    //     }

    //     $atelier->ressources()->detach($ressource);
    //     return response()->json(['data' => $ressource]);
    //    }
}
