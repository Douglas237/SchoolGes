<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use App\Models\Eleve;
use App\Models\Sequence;
use App\Models\Trimestre;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnnuelRequest;
use App\Http\Requests\NoteSeqRequest;
use App\Http\Requests\NoteTrimRequest;
use App\Models\Classe;
use App\Models\SalleClasse;

class ResultatsController extends Controller
{
    public function sequence(NoteSeqRequest $request)
    {
        $data = [];
        $moyenes = [];
        $resulta = [];
        $somme = 0;
        $coef = 0;
        $i = 0;
        $general = 0;
        $eleve = Eleve::where('eleves.salleclasse_id', $request->salle_id)->get()->toArray();
        // dd($eleve[0]['id'])
        /*------------------------------- Parcour des eleves ayant des notes ----------------------------- */
        foreach ($eleve as $value) {
            # code...
            // dd($value);
            $notes = Note::join('matieres', 'matieres.id', '=', 'notes.matiere_id')
                ->join('eleves', 'eleves.id', '=', 'notes.eleve_id')
                ->join('sequences', 'sequences.id', '=', 'notes.sequence_id')
                ->join('classes', 'classes.id', '=', 'notes.classe_id')
                ->join('salle_classes', 'salle_classes.id', '=', 'notes.salleclasse_id')
                ->join('matiere_systems', 'matiere_systems.id', '=', 'matieres.matieresyst_id')
                ->where('eleve_id', $value['id'])
                ->where('notes.sequence_id', $request->sequence_id)
                ->get([
                    'eleves.nom',
                    'eleves.prenom',
                    'eleves.date_naissance',
                    'eleves.lieu_naissance',
                    'eleves.genre',
                    'notes.note',
                    'matieres.intituler_etablissement',
                    'matieres.coefficient_etablissement',
                    'matiere_systems.coefficient_generale',
                    'sequences.id as sequence_id',
                    'salle_classes.code_salle_classe as salle',
                    'classes.nom_classe as classe',
                ])
                ->toArray();

            // dd($notes);
            if (!empty($notes)) {
                # code...
                // dd($notes[1]['coefficient_etablissement'] == null);
                // dd($notes);
                // $resulta = $notes;
                // dd($resulta);
                for ($n = 0; $n < count($notes); $n++) {
                    # code...
                    if ($notes[$n]['coefficient_etablissement'] == null) {
                        # code...
                        $coef = $coef + $notes[$n]['coefficient_generale'];
                        $unic = $notes[$n]['note'] * $notes[$n]['coefficient_generale'];
                        $somme = $somme + $unic;
                    } else {
                        $coef = $coef + $notes[$n]['coefficient_etablissement'];
                        $unic = $notes[$n]['note'] * $notes[$n]['coefficient_etablissement'];
                        $somme = $somme + $unic;
                    }
                    // dump($notes[$n]['coefficient_etablissement']);
                    // dump($notes[$n]['note']);
                }
                // foreach ($notes as $note) {
                //     # code...
                //     // dump($note['note']);
                //     $somme = $somme+$note['note'];
                // }
                // dd($coef);
                $unicmoyene = $somme / $coef;
                // dd($unicmoyene);
                array_push($moyenes, $unicmoyene);
                // dd($moyenes);
                // dd($notes[2]['nom']);
                $whitavrage = [
                    "eleve_id" => $value['id'],
                    "nom" => $notes[$i]['nom'],
                    "prenom" => $notes[$i]['prenom'],
                    "date_naissance" => $notes[$i]['date_naissance'],
                    "lieu_naissance" => $notes[$i]['lieu_naissance'],
                    "genre" => $notes[$i]['genre'],
                    "moyenne" => $unicmoyene,
                    "totale_points" => $somme,
                    "classe" => Classe::where("id",$value['classe_id'])->get(),
                    "salle_classe" => SalleClasse::where("id",$value['salleclasse_id'])->get(),
                ];
                array_push($data, $whitavrage);
            }
            // dump($whitavrage);
            // $i++;
            $somme = 0;
            $coef = 0;
            // dd($i);
            // dd($data);
        }

        // if (!Empty($data)) {
        //     dd(count($data)-1);
        //     # code...
        // }

        /*----------------------------------- Moyenne generale -------------------------------------------*/
        for ($m = 0; $m <= count($moyenes) - 1; $m++) {
            # code...
            $general = $moyenes[$m] + $general;
        }

        $moyenegenerale = $general / count($moyenes);
        // dd($moyenegenerale);

        /*-------------------------------------- Classification des moyennes -------------------------------*/
        for ($j = 0; $j < count($moyenes) - 1; $j++) {
            # code...
            for ($k = $j + 1; $k <= count($moyenes) - 1; $k++) {
                # code...
                if ($moyenes[$k] > $moyenes[$j]) {
                    # code...
                    $var = $moyenes[$j];
                    $moyenes[$j] = $moyenes[$k];
                    $moyenes[$k] = $var;
                }
            }
        }

        // dd($moyenes);
        /*----------------------------------------- Resulta d'un eleve --------------------------------------*/

        for ($t = 0; $t <= count($data) - 1; $t++) {
            # code...
            // dd($moyenes[0]);
            $unicnote = [
                "eleve_id" => $data[$t]['eleve_id'],
                "nom" => $data[$t]['nom'],
                "prenom" => $data[$t]['prenom'],
                "date_naissance" => $data[$t]['date_naissance'],
                "lieu_naissance" => $data[$t]['lieu_naissance'],
                "genre" => $data[$t]['genre'],
                "moyenne" => $data[$t]['moyenne'],
                "appreciation" => Helper::apprciation($data[$t]['moyenne']),
                "moyenne_generale" => $moyenegenerale,
                "moyenne_premier" =>  $moyenes[0],
                "moyenne_dernier" => $moyenes[count($moyenes) - 1],
                "rang" => Helper::rang($moyenes, $data[$t]['moyenne']),
                "classe" => $data[$t]['classe'],
                "salle_classe" => $data[$t]['salle_classe'],
            ];
            // array_push($resulta, $unicall);
            array_push($resulta, $unicnote);
        }
        // dd(count($moyenes));

        return response()->json([
            'message' => 'test',
            'data' => $resulta
        ]);
    }


    public function trimestre(NoteTrimRequest $request)
    {
        $data = [];
        $test = [];
        $moyenes = [];
        $resulta = [];
        $moyenne = 0;
        $general = 0;
        $seqA = [];
        $seqB = [];
        $seq = Sequence::where('sequences.trimestre_id', $request->trimestre_id)->get(['num_sequences'])->toArray();
        $eleve = Eleve::where('eleves.salleclasse_id', $request->salle_id)->get()->toArray();
        /*------------------------------- Parcour des eleves ayant des notes ----------------------------- */

        // dd($seq);
        if (!empty($eleve)) {
            # code...
            foreach ($eleve as $value) {
                # code...
                $seqA = Helper::moyennesequentiel($value['id'], $seq[0]['num_sequences']);
                $seqB = Helper::moyennesequentiel($value['id'], $seq[1]['num_sequences']);
                // array_push($test, $seqB);
                // dd($seqA[0]['moyenne']);
                $moyenne = ($seqA[0]['moyenne'] + $seqB[0]['moyenne']) / 2;

                // dd($seqA);
                array_push($moyenes, $moyenne);
                $trim = [
                    "eleve_id" => $value['id'],
                    "nom" => $seqA[0]['nom'],
                    "prenom" => $seqA[0]['prenom'],
                    "date_naissance" => $seqA[0]['date_naissance'],
                    "lieu_naissance" => $seqA[0]['lieu_naissance'],
                    "genre" => $seqA[0]['genre'],
                    "moyenne_seq".$seq[0]['num_sequences'] => $seqA[0]['moyenne'],
                    "moyenne_seq".$seq[1]['num_sequences'] => $seqB[0]['moyenne'],
                    "moyenne_trim".$request->trimestre_id => $moyenne,
                    "classe" => Classe::where("id",$value['classe_id'])->get(),
                    "salle_classe" => SalleClasse::where("id",$value['salleclasse_id'])->get(),
                ];
                // dd($trim);
                array_push($data, $trim);
                // dd($data[0]);
                $moyenne = 0;
            }
            /*----------------------------------- Moyenne generale -------------------------------------------*/

            for ($m = 0; $m <= count($moyenes) - 1; $m++) {
                # code...
                $general = $moyenes[$m] + $general;

                // dump($general);
            }

            $moyenegenerale = $general / count($moyenes);


            /*-------------------------------------- Classification des moyennes -------------------------------*/

            for ($j = 0; $j < count($moyenes) - 1; $j++) {
                # code...
                for ($k = $j + 1; $k <= count($moyenes) - 1; $k++) {
                    # code...
                    if ($moyenes[$k] > $moyenes[$j]) {
                        # code...
                        $var = $moyenes[$j];
                        $moyenes[$j] = $moyenes[$k];
                        $moyenes[$k] = $var;
                    }
                }
            }
            /*----------------------------------------- Resulta d'un eleve --------------------------------------*/

            for ($t = 0; $t <= count($data) - 1; $t++) {
                # code...
                // dd($data[$t]['nom']);
                $unicnote = [
                    "eleve_id" => $data[$t]['eleve_id'],
                    "nom" => $data[$t]['nom'],
                    "prenom" => $data[$t]['prenom'],
                    "date_naissance" => $data[$t]['date_naissance'],
                    "lieu_naissance" => $data[$t]['lieu_naissance'],
                    "genre" => $data[$t]['genre'],
                    "moyenne_seq".$seq[0]['num_sequences'] => $data[$t]["moyenne_seq".$seq[0]['num_sequences']],
                    "moyenne_seq".$seq[1]['num_sequences'] => $data[$t]["moyenne_seq".$seq[1]['num_sequences']],
                    "moyenne_trim".$request->trimestre_id => $data[$t]["moyenne_trim".$request->trimestre_id],
                    "appreciation" => Helper::apprciation($data[$t]["moyenne_trim".$request->trimestre_id]),
                    "moyenne_generale" => $moyenegenerale,
                    "moyenne_premier" =>  $moyenes[0],
                    "moyenne_dernier" => $moyenes[count($moyenes) - 1],
                    "rang" => Helper::rang($moyenes, $data[$t]["moyenne_trim".$request->trimestre_id]),
                    "classe" => $data[$t]['classe'],
                    "salle_classe" => $data[$t]['salle_classe'],
                ];
                // array_push($resulta, $unicall);
                array_push($resulta, $unicnote);
                // dd($resulta);
            }

            return response()->json([
                'message' => 'trimestre',
                'data' => $resulta
            ]);
        } else {
            return response()->json(["message" => " soit les sequences pour ce trimestre n'exite pas soit la classe n"]);
        }
    }

    public function annuel(AnnuelRequest $request)
    {
        $data = [];
        $un = [];
        $somme = 0;
        $moyenes = [];
        $resulta = [];
        $moyenne = 0;
        $general = 0;

        /* --------- les eleves ------------------------ */
        $eleve = Eleve::where('eleves.salleclasse_id', $request->salle_id)->get()->toArray();
        // dd($eleve);
        /*---------- les trimestres --------------------- */
        $alltrim = Trimestre::get(['num_trimestre'])->toArray();
        // dd($alltrim);
        if (!empty($eleve)) {

            /*------------ tous les notes trimestriel d'un eleve --------- */
            foreach ($eleve as $value) {
                # code...

                for ($i = 0; $i <= count($alltrim) - 1; $i++) {
                    # code...
                    // dump($value['id']);
                    $trims = Helper::trimestre($value['id'], $alltrim[$i]['num_trimestre']);
                    $somme = $somme + $trims[0]['moyenne_trim'.($i+1)];
                }
                $un = Helper::trimestre($value['id'], $alltrim[0]['num_trimestre']);
                // dump($un);
                $moyenne = $somme / count($alltrim);
                array_push($moyenes, $moyenne);
                // dd($un[0][0]['nom']);
                $unic = [
                    "eleve_id" => $value['id'],
                    "nom" => $un[0]['nom'],
                    "prenom" => $un[0]['prenom'],
                    "date_naissance" => $un[0]['date_naissance'],
                    "lieu_naissance" => $un[0]['lieu_naissance'],
                    "genre" => $un[0]['genre'],
                    "moyenne_annuel" => $moyenne,
                    "classe" => Classe::where("id",$value['classe_id'])->get(),
                    "salle_classe" => SalleClasse::where("id",$value['salleclasse_id'])->get(),
                ];

                array_push($data, $unic);
                $somme = 0;
                $moyenne = 0;
            }

            /*----------------------------------- Moyenne generale -------------------------------------------*/
            for ($m = 0; $m <= count($moyenes) - 1; $m++) {
                # code...
                $general = $moyenes[$m] + $general;
            }
            $moyenegenerale = $general / count($moyenes);

            /*-------------------------------------- Classification des moyennes -------------------------------*/

            for ($j = 0; $j < count($moyenes) - 1; $j++) {
                # code...
                for ($k = $j + 1; $k <= count($moyenes) - 1; $k++) {
                    # code...
                    if ($moyenes[$k] > $moyenes[$j]) {
                        # code...
                        $var = $moyenes[$j];
                        $moyenes[$j] = $moyenes[$k];
                        $moyenes[$k] = $var;
                    }
                }
            }

            /*----------------------------------------- Resulta d'un eleve --------------------------------------*/

            for ($t = 0; $t <= count($data) - 1; $t++) {
                # code...
                // dd($moyenes[0]);
                $unicnote = [
                    "eleve_id" => $data[$t]['eleve_id'],
                    "nom" => $data[$t]['nom'],
                    "prenom" => $data[$t]['prenom'],
                    "date_naissance" => $data[$t]['date_naissance'],
                    "lieu_naissance" => $data[$t]['lieu_naissance'],
                    "genre" => $data[$t]['genre'],
                    "moyenne_annuel" => $data[$t]["moyenne_annuel"],
                    "appreciation" => Helper::apprciation($data[$t]["moyenne_annuel"]),
                    "moyenne_generale" => $moyenegenerale,
                    "moyenne_premier" =>  $moyenes[0],
                    "moyenne_dernier" => $moyenes[count($moyenes) - 1],
                    "rang" => Helper::rang($moyenes, $data[$t]["moyenne_annuel"]),
                    "classe" => $data[$t]['classe'],
                    "salle_classe" => $data[$t]['salle_classe'],
                ];
                // array_push($resulta, $unicall);
                array_push($resulta, $unicnote);
            }

            return response()->json([
                'message' => 'annuel',
                'data' => $resulta
            ]);
        }
        else
        {
            return response()->json(["message" => " soit les sequences pour ce trimestre n'exite pas soit la classe n"]);
        }
    }
}
