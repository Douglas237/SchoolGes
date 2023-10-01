<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Matiere;
use App\Models\SalleBase;
use App\Models\CahierTexte;
use App\Models\SalleClasse;
use Illuminate\Http\Request;
use App\Models\programme_matiere;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCahierTextRequest;
use App\Http\Requests\UpdateCahierTextRequest;
use App\Http\Requests\CahiertextesProgrammematieresRequest;

class CahierTexteController extends Controller
{
    //lisre des cahiers de texte
    public function index()
    {
        $cahiertext = CahierTexte::all();
        return response()->json([
            'statut_code' => 200,
            'statut_message' => 'liste des cahier de texte',
            'data' => $cahiertext
        ]);
    }

    //creation d'un cahier de texte

    public function store(StoreCahierTextRequest  $request)
    {

        try {
            $sallebase = SalleClasse::where('salle_classes.id', $request->salleClasse_id)->get();
            $matiere = Matiere::where('matieres.id', $request->matiere_id)->get();
            if ($sallebase->isEmpty() ||$matiere->isEmpty()  ) {
                return response()->json([
                    'status_message' => 'Aucune salle selectionner'
                ]);
            }
            $cahiertexte = CahierTexte::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'cahier de texte ajouté',
                'data' => $cahiertexte
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // modification d'un cahier de texte

    public function update(UpdateCahierTextRequest $request, $id)
    {
        try {

            $sallebase = SalleClasse::where('salle_classes.id', $request->salleClasse_id)->get();
            $matiere = Matiere::where('matieres.id', $request->matiere_id)->get();
            if ($sallebase->isEmpty() || $matiere->isEmpty()) {
                return response()->json([
                    'status_message' => 'Aucune salle selectionner'
                ]);
            }
            $cahiertext = CahierTexte::Find($id);
            $cahiertext->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => 'cahier de texte modifier',
                'data' => $cahiertext
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 422,
                'status_message' => 'erreur de modification'
            ]);
        }
    }


    // public function addPost() {
    //     $post = new Post;
    //     $post->title = "Hello world";
    //     $post->short_desc = "Hello world";
    //     $post->save();

    //     $content = new Content;
    //     $content->description = 'hello world post description';
    //     $content->post_content()->save($content);
    // }

    // supprimer un cahier de texte

    public  function destroy($id)
    {
        try {
            if ($id) {
                $cahiertext = CahierTexte::find($id);
                $cahiertext->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'cahier de texte supprimer',
                    'data' => $cahiertext
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'cahier de texte introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // afficher les informations d'un cahier de texte
    public function show($id)
    {
        try {
            if ($id) {
                $cahiertext = CahierTexte::find($id);
                return response()->json([
                    'status_message' => 'detail du cahier de texte',
                    'data' => $cahiertext
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'cahier de texte non existant'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // cahier de texte d'une salle de classe
    public function cahiertexte($id)
    {
        try {
            if ($id) {
                $cahiertext = CahierTexte::where('cahier_textes.salleClasse_id', $id)->get();

                if ($cahiertext->isEmpty()) {
                    return response()->json(["status_message" => "Aucun cahier de texte pour cette salle de classe"]);
                }
                return response()->json([
                    'status_message' => 'cahier de texte pour cette salle de classe',
                    'data' => $cahiertext
                ]);
            } else {

                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'cahier de texte non existant'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }



}
