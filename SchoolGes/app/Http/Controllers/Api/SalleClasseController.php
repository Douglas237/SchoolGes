<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Classe;
use App\Models\SalleClasse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalleClasseRequest;
use App\Http\Requests\UpdateSalleClasseRequest;
use App\Models\BlocSalle;

class SalleClasseController extends Controller
{
    // liste des salles de classes
    public function index()
    {
        $salleclasse = SalleClasse::join('classes', 'classes.id','=','salle_classes.classe_id')
                                ->join('bloc_salles', 'bloc_salles.id','=','salle_classes.blocsalle_id')
                                ->get([
                                    "salle_classes.*","classes.nom_classe","bloc_salles.libelle"
                                ]);
        return response()->json([
            'statut_code' => 200,
            'statut_message' =>'liste des salles de classe',
            'data' => $salleclasse
        ]);

    }

    // creation des salles de classes

    public function store(StoreSalleClasseRequest $request)
    {
        try {
            $classe = Classe::where('classes.id', $request->classe_id)->get();
            $blocsalle = BlocSalle::where('bloc_salles.id', $request->blocsalle_id)->get();
            if($classe->isEmpty() || $blocsalle->isEmpty())
            {
                return response()->json([
                    'status_message' => 'classe ou bloc de salle non selectionner'
                ]);
            }

            $salleclasse = SalleClasse::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'salle de classe ajouté',
                'data' => $salleclasse
            ]);

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // modofication d'une salle de classe

    public function update(UpdateSalleClasseRequest $request, $id)
    {
        try {
            $classe = Classe::where('classes.id', $request->classe_id)->get();
            $blocsalle = BlocSalle::where('bloc_salles.id', $request->blocsalle_id)->get();
            if($classe->isEmpty() || $blocsalle->isEmpty())
            {
                return response()->json([
                    'status_message' => 'classe ou bloc de salle non selectionner'
                ]);
            }

            $salleclasse = Salleclasse::Find($id);
            $salleclasse->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'salle de classe modifiée',
                'data' => $salleclasse
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }

    }

    // afficher les informations d'une salle de classe
    public function show($id)
    {
        try {
            if($id) {
                $salleclasse = SalleClasse::find($id);
                return response()->json([
                    'status_message' => 'detail de la salle de classe',
                    'data' => $salleclasse
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                'status_message' => 'salle de classe non existant'
                ]);
            }
        } catch(Exception $e) {
            return response()->json($e);
        }
    }

        // supprimer une salle de classe
        public  function destroy($id)
        {
            try {
                if($id) {
                    $salleclasse = SalleClasse::find($id);
                    $salleclasse->delete();

                    return response()->json([
                        'status_code' => 200,
                        'status_message' => 'salle de classe supprimer',
                        'data' => $salleclasse
                    ]);
                } else {
                    return response()->json([
                        'status_code' => 422,
                        'status_message' => 'salle de classe introuvable'
                    ]);
                }
            } catch(Exception $e) {
                return response()->json($e);
            }
        }

            //afficher les salles de classe d'une classe

    public function salleclasses($id)
    {
        try{
            if($id)
            {
                $salleclasse = SalleClasse::where('salle_classes.classe_id', $id)->get();

                if($salleclasse->isEmpty())
                {
                    return response()->json(["status_message" => "Aucune salle de classe pour cette classe"]);
                }

                return response()->json([
                    'status_message' => 'salle de classe pour cette classe',
                    'data' => $salleclasse
                ]);
            }else {
                return response()->json([
                'status_code' => 422,
                'status_message' => 'salle de classe non existante'
                ]);
            }

        } catch(Exception $e)
        {
            return response()->json($e);
        }

    }
}
