<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\ClasseSystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClasseSystemRequest;
use App\Http\Requests\UpdateClasseSystemRequest;
use App\Models\Admincirconscription;

class ClasseSystemController extends Controller
{
    // listing des classes du systeme
    public function index()
    {
        try {
            $classe = ClasseSystem::all();
            //   dd($evenement);
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'liste des classes creee dans le systeme',
                'data' => $classe
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    //creation d'une classe dans le systeme

    public function store(StoreClasseSystemRequest  $request)
    {

        try {

            $admincircons = Admincirconscription::where('admincirconscriptions.id', $request->admincirconscription_id)->get();

            if ($admincircons->isEmpty()) {
                return response()->json(["status_message" => "admin circonscription non existant"]);
            }

            $classe = ClasseSystem::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Cette classe a ete ajoutée',
                'data' => $classe
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'une classe du systeme
    public function update(UpdateClasseSystemRequest $request, $id)
    {
        try {

            $admincircons = Admincirconscription::where('admincirconscriptions.id', $request->admincirconscription_id)->get();

            if ($admincircons->isEmpty()) {
                return response()->json(["status_message" => "admin circonscription non existant"]);
            }
            $classe = ClasseSystem::Find($id);
            $classe->update($request->validated());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'La classe a ete modifier',
                'data' => $classe
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }

    // supprimer une classe du system
    public  function destroy($id)
    {
        try {
            if ($id) {
                $classe = ClasseSystem::find($id);
                $classe->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'classe supprimer',
                    'data' => $classe
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Classe introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'une classe du systeme
    public function show($id)
    {
        try {
            if ($id) {
                $classe = ClasseSystem::find($id);
                return response()->json([
                    'status_message' => 'detail de la classe',
                    'data' => $classe
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'Classe non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
