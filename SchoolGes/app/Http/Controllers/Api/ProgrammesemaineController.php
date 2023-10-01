<?php

namespace App\Http\Controllers;

use App\Models\CahierTexte;
use Illuminate\Http\Request;
use App\Models\Programmesemaine;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProgrammesemaineResource;
use App\Http\Requests\ProgrammesemainesMatiereRequest;
use App\Http\Requests\ProgrammesemainesCahiertexteRequest;
use App\Models\Matiere;

class ProgrammesemaineController extends Controller
{
    public function index()
    {


        try {
            //code...
            $PrograProgrammesemaines =ProgrammesemaineResource::collection(Programmesemaine::all());
            return $PrograProgrammesemaines;
        } catch (\Throwable $e) {
            //throw $e;
            return response()->json($e);
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        //  dd($request);
        $validator = Validator::make($request->all(), [
            'num_programme' => 'required',
            'semaine_programme' => 'required',
            'jour' => 'required',
            'date' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'salleClasse_id' => 'required',
            'enseignant_id' => 'required',
        ]);
        // dd($validator->fails());
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }
        try {

            $Programmesemaine = new Programmesemaine();
            $Programmesemaine->num_programme = $request->num_programme;
            $Programmesemaine->semaine_programme = $request->semaine_programme;
            $Programmesemaine->jour = $request->jour;
            $Programmesemaine->date = $request->date;
            $Programmesemaine->heure_debut = $request->heure_debut;
            $Programmesemaine->heure_fin = $request->heure_fin;
            $Programmesemaine->salleClasse_id = $request->salleClasse_id;
            $Programmesemaine->enseignant_id = $request->enseignant_id;
            $Programmesemaine->save();
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'le paiements a ete Ajoute avec success!!!!!.',
                'data' => $Programmesemaine
            ]);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }



    }

    public function show($id)
    {
        $PrograProgrammesemaine =Programmesemaine::find($id);
        if ($PrograProgrammesemaine != null) {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'edit view success😎😎.',
                'data' => $PrograProgrammesemaine
            ]);
        }
        return response()->json([
            'message' => 'PrograProgrammesemaine Not Found.'
        ], 404);
    }




    public function update(Request $request,$id)
    {
        try {
            $Programmesemaine =Programmesemaine::find($id);
            if (!$Programmesemaine) {
                return response()->json([
                    'mesage' => 'Programmesemaine Not Found'
                ], 404);
            }
            $Programmesemaine->num_programme = $request->num_programme;
            $Programmesemaine->semaine_programme = $request->semaine_programme;
            $Programmesemaine->jour = $request->jour;
            $Programmesemaine->date = $request->date;
            $Programmesemaine->heure_debut = $request->heure_debut;
            $Programmesemaine->heure_fin = $request->heure_fin;
            $Programmesemaine->salleClasse_id = $request->salleClasse_id;
            $Programmesemaine->enseignant_id = $request->enseignant_id;
            $Programmesemaine->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Modification effectuer avec success.',
                'data' => $Programmesemaine
            ]);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json($e);
        }
    }

    public function delete($id)
    {
        $Programmesemaine  =Programmesemaine::find($id);
        if (!$Programmesemaine) {
            return response()->json([
                'message' => 'Programmesemaine Not Found.'
            ], 404);
        }
        $Programmesemaine->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'La a ete Supprimer avec success!!!!!!!!!!.',
            'data' => $Programmesemaine
        ]);
    }



    public function storeAssign(ProgrammesemainesCahiertexteRequest $request)
    {

        try {

            // dd($request);
            $cahiers = CahierTexte::FindOrFail($request->cahiertexte_id);
            $Programmesemaine = Programmesemaine::FindOrFail($request->prgSemaine_id);
            $Programmesemaine->cahiers()->attach($cahiers);

            return response()->json([
                'status_code' => 200,
                'status_message' => 'La classe a ete assigner avec success!!!!!.',
                'data' => $Programmesemaine,
            ]);
        } catch (\Exception $e) {

            return response()->json($e);

        }

    }

    // public function createDetach(string  $id)
    // {
    //     $Classe = Classe::FindOrFail($id);
    //     $paiements = Paiement::all();
    //     return response()->json([
    //         'status_code' => 200,
    //         'status_message' => 'Le detachement de la Zone a ete creer avec succes Zone a ete success!!!!!.',
    //         'data' => $paiements,$Classe
    //     ]);
    // }


    // public function showClassePaiement($id)
    // {
    //     $unic_classe = ClassesPaiement::where('classe_id', $id)->get();

    //     if ($unic_classe->isEmpty()) {
    //         # code...
    //         return response()->json(['message' => "cet classe  n'a pas de paiement"], 404);
    //     }
    //     // jointures des $cantines_produits et produits pour avoir les produits d'une cantine donner
    //     $paiements = ClassesPaiement::join('classes', 'classes_paiements.classe_id', '=', 'classes.id')
    //         ->where('classe_id', $id)
    //         ->join('paiements', 'classes_paiements.paiement_id', '=', 'paiements.id')
    //         ->get();
    //     // dd($produits);
    //     if ($paiements->isEmpty()) {
    //         # code...
    //         return response()->json(['message' => "donner introuvable car la classe ou le paiement n'existe pas"]);
    //     }

    //     return ClassePaiementResource::collection($paiements);
    // }



    public function storeDetach(ProgrammesemainesCahiertexteRequest $request)
    {

        try {
            $cahiers = CahierTexte::FindOrFail($request->cahiertexte_id);
            $Programmesemaine = Programmesemaine::FindOrFail($request->prgSemaine_id);
            $Programmesemaine->cahiers()->detach($cahiers);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $Programmesemaine
            ]);
        } catch (\Exception $e) {

            return response()->json($e);
        }

    }

    public function moveMatieres(ProgrammesemainesMatiereRequest $request)
    {

        try {
            $matieres = Matiere::FindOrFail($request->cahiertexte_id);
            $Programmesemaine = Programmesemaine::FindOrFail($request->prgSemaine_id);
            $Programmesemaine->cahiers()->detach($matieres);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $Programmesemaine
            ]);
        } catch (\Exception $e) {

            return response()->json($e);
        }

    }


    public function attachMatieres(ProgrammesemainesMatiereRequest $request)
    {

        try {
            $matieres = CahierTexte::FindOrFail($request->cahiertexte_id);
            $Programmesemaine = Programmesemaine::FindOrFail($request->prgSemaine_id);
            $Programmesemaine->matieres()->attach($matieres);;

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Le detachement reussit!!!!!.',
                'data' => $Programmesemaine
            ]);
        } catch (\Exception $e) {

            return response()->json($e);
        }

    }
}
