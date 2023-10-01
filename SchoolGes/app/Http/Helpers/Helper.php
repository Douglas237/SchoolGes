<?php
namespace App\Http\Helpers;

use App\Models\Note;
use App\Models\Eleve;
use App\Models\Sequence;
use App\Models\Trimestre;
use Illuminate\Http\Exceptions\HttpResponseException;

class Helper
{
    public static function sendError($message, $errors = [], $code = 401)
    {
        $response = ["success" => false, "message" => $message];
        if (!empty($errors)) {
            # code...
            $response["data"] = $errors;
        }
        throw new HttpResponseException(response()->json($response,$code));
    }

    /*----------------------------------------- Appreciation des eleves ------------------------------------*/
    public static function apprciation($note)
    {
        $value = "";
        switch ($note) {
            case $note < 8:
                # code...
                $value = "Mediocre";
                break;
            case $note >= 8 && $note < 10:
                # code...
                $value = "Inssufisant";
                break;
            case $note >= 10 && $note < 12:
                # code...
                $value = "Passable";
                break;
            case $note >= 12 && $note < 14:
                # code...
                $value = "Assez bien";
                break;
            case $note >= 14 && $note < 16:
                # code...
                $value = "Bien";
                break;
            case $note >= 16 && $note < 18:
                # code...
                $value = "Tres Bien";
                break;
            case $note >= 18 && $note < 20:
                # code...
                $value = "Exellent";
                break;
        }

        return $value;
    }

    /*---------------------------------- Determination du rang des eleves -----------------------------------*/
    public static function rang($moyenes, $note)
    {
        // count($moyenes);
        $rang = 0;
        for ($i=0; $i <= count($moyenes)-1 ; $i++) {
            # code...
            if ($moyenes[$i] == $note) {
                # code...
                $rang = $i;
                return $rang+1;
            }
        }

    }

    public static function moyennesequentiel($eleve, $sequence)
    {
        $data = [];
        $resulta = [];
        $somme = 0;
        $coef = 0;
        $i = 0;
        $idsequence = Sequence::where('sequences.num_sequences',$sequence)->get(['id'])->toArray();
        // dd($idsequence);
        $notes = Note::join('matieres','matieres.id', '=', 'notes.matiere_id')
                        ->join('eleves', 'eleves.id', '=', 'notes.eleve_id')
                        ->join('sequences', 'sequences.id', '=', 'notes.sequence_id')
                        ->join('classes', 'classes.id', '=', 'notes.classe_id')
                        ->join('salle_classes', 'salle_classes.id', '=','notes.salleclasse_id')
                        ->join('matiere_systems', 'matiere_systems.id', '=', 'matieres.matieresyst_id')
                        ->where('eleve_id',$eleve)
                        ->where('notes.sequence_id',$idsequence[0]['id'])
                        ->get([
                            'eleves.nom',
                            'eleves.prenom',
                            'eleves.date_naissance',
                            'eleves.lieu_naissance',
                            'eleves.genre',
                            'notes.note' ,
                            'matieres.intituler_etablissement',
                            'matieres.coefficient_etablissement',
                            'matiere_systems.coefficient_generale',
                            'sequences.id as sequence_id',
                            'salle_classes.code_salle_classe as salle',
                            'classes.nom_classe as classe',
                            ])
                        ->toArray();

        // dd($notes);
            if (! Empty($notes)) {
                # code...
                // dd($notes[1]['coefficient_etablissement'] == null);
                // dd($notes);
                for ($n=0; $n < count($notes); $n++) {
                    # code...
                    if ($notes[$n]['coefficient_etablissement'] == null) {
                        # code...
                        $coef = $coef + $notes[$n]['coefficient_generale'];
                        $unic = $notes[$n]['note']*$notes[$n]['coefficient_generale'];
                        $somme = $somme+$unic;
                    }
                    else
                    {
                        $coef = $coef + $notes[$n]['coefficient_etablissement'];
                        $unic = $notes[$n]['note']*$notes[$n]['coefficient_etablissement'];
                        $somme = $somme+$unic;
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
                // array_push($moyenes, $unicmoyene);
                // dd($moyenes);
                // dd($notes[2]['nom']);
                $whitavrage = [
                    "nom" =>$notes[$i]['nom'],
                    "prenom" =>$notes[$i]['prenom'],
                    "date_naissance" =>$notes[$i]['date_naissance'],
                    "lieu_naissance" =>$notes[$i]['lieu_naissance'],
                    "genre" =>$notes[$i]['genre'],
                    "moyenne" =>$unicmoyene,
                    "totale_points" => $somme,
                ];
                array_push($data, $whitavrage);
            }
            // dump($whitavrage);
            // $i++;
            // $somme = 0;
            // $coef = 0;
            // dd($i);
            // dd($data);

        // dd($moyenes);
        /*----------------------------------------- Resulta d'un eleve --------------------------------------*/
        for ($t = 0; $t <= count($data) - 1 ; $t++) {
            # code...
            // dd($moyenes[0]);
            $unicnote = [
                "nom" =>$data[$t]['nom'],
                "prenom" =>$data[$t]['prenom'],
                "date_naissance" =>$data[$t]['date_naissance'],
                "lieu_naissance" =>$data[$t]['lieu_naissance'],
                "genre" =>$data[$t]['genre'],
                "moyenne" =>$data[$t]['moyenne'],
                "totale_points" =>$data[$t]['totale_points'],
                "appreciation" => Helper::apprciation($data[$t]['moyenne']),
            ];
            // array_push($resulta, $unicall);
            array_push($resulta, $unicnote);

        }
        // dd($resulta);

       return  $resulta;
    }

    public static function trimestre ($eleve, $trimestre)
    {
        $data = [];
        $resulta = [];
        $moyenne = 0;
        $seqA = [];
        $seqB = [];
        $seq = Sequence::where('sequences.trimestre_id', $trimestre)->get(['num_sequences'])->toArray();
        // $eleve = Eleve::where('eleves.salleclasse_id',$request->salle_id)->get()->toArray();
      /*------------------------------- Parcour des eleves ayant des notes ----------------------------- */

        // dd($seq[0]['num_sequences']);
        if (! Empty($seq)) {
            # code...

                # code...
                // dd($eleve,$seq[0]['num_sequences']);
                $seqA = Helper::moyennesequentiel($eleve,$seq[0]['num_sequences']);
                // dd($seqA);
                $seqB = Helper::moyennesequentiel($eleve,$seq[1]['num_sequences']);
                $sometrim = $seqA[0]['totale_points'] + $seqB[0]['totale_points'];
                $moyenne = ($seqA[0]['moyenne'] + $seqB[0]['moyenne'])/2;

                // dd($seqA);
                // array_push($moyenes, $moyenne);
                $trim = [
                    "nom" =>$seqA[0]['nom'],
                    "prenom" =>$seqA[0]['prenom'],
                    "date_naissance" =>$seqA[0]['date_naissance'],
                    "lieu_naissance" =>$seqA[0]['lieu_naissance'],
                    "genre" =>$seqA[0]['genre'],
                    "moyenne_seq".$seq[0]['num_sequences'] => $seqA[0]['moyenne'],
                    "moyenne_seq".$seq[1]['num_sequences'] => $seqB[0]['moyenne'],
                    "somme_point_trim" => $sometrim,
                    "moyenne_trim".$trimestre =>$moyenne,
                ];
                array_push($data, $trim);
                // dd($data);
                $sometrim = 0;
                // $moyenne = 0;

            for ($t = 0; $t <= count($data) - 1 ; $t++) {
                # code...
                // dd($moyenes[0]);
                $unicnote = [
                    "nom" =>$data[$t]['nom'],
                    "prenom" =>$data[$t]['prenom'],
                    "date_naissance" =>$data[$t]['date_naissance'],
                    "lieu_naissance" =>$data[$t]['lieu_naissance'],
                    "genre" =>$data[$t]['genre'],
                    "moyenne_seq".$seq[0]['num_sequences'] => $data[$t]["moyenne_seq".$seq[0]['num_sequences']],
                    "moyenne_seq".$seq[1]['num_sequences'] => $data[$t]["moyenne_seq".$seq[1]['num_sequences']],
                    "moyenne_trim".$trimestre =>$data[$t]["moyenne_trim".$trimestre],
                    "somme_point_trim" => $data[$t]["somme_point_trim"],
                    "appreciation" => Helper::apprciation($data[$t]["moyenne_trim".$trimestre]),
                ];
                // array_push($resulta, $unicall);
                array_push($resulta, $unicnote);

            }

            return $resulta;
        }
        else
        {
            return response()->json(["message" => " soit les sequences pour ce trimestre n'exite pas soit la classe n"]);
        }
    }

    public static function bulletinSequence($eleve, $matiere, $sequence)
    {
        $note = Note::join('matieres','notes.matiere_id','=','matieres.id')
                        ->where('notes.matiere_id', $matiere)
                        ->where('notes.eleve_id' , $eleve)
                        ->where('notes.sequence_id', $sequence)
                        ->get([
                            'matieres.intituler_etablissement as intituler',
                            'note',
                            'matieres.coefficient_etablissement as coef'
                        ])->toArray();

        $note_calculer = $note[0]['note']*$note[0]['coef'];
        // dd($note);
        $result = [
            'intituler' => $note[0]['intituler'],
            'note' => $note[0]['note'],
            'coef' => $note[0]['coef'],
            'note_coeffitier' => $note_calculer,
        ];

        return $result;
    }


    public static function bulletinTrimestre($eleve, $matiere, $trim)
    {

        $sequence = Sequence::where('sequences.trimestre_id',$trim)->get(['sequences.id','sequences.num_sequences'])
                                ->toArray();
                                // dd($trim);
        $note1 = Note::join('matieres','notes.matiere_id','=','matieres.id')
                        ->where('notes.matiere_id', $matiere)
                        ->where('notes.eleve_id' , $eleve)
                        ->where('notes.sequence_id', $sequence[0]['id'])
                        ->get([
                            'matieres.intituler_etablissement as intituler',
                            'note',
                            'matieres.coefficient_etablissement as coef'
                        ])->toArray();
        // dd($note1);
        $note2 = Note::join('matieres','notes.matiere_id','=','matieres.id')
                        ->where('notes.matiere_id', $matiere)
                        ->where('notes.eleve_id' , $eleve)
                        ->where('notes.sequence_id', $sequence[1]['id'])
                        ->get([
                            'matieres.intituler_etablissement as intituler',
                            'note',
                            'matieres.coefficient_etablissement as coef'
                        ])->toArray();
                        dd($note2);


        $note_calculer = ($note1[0]['note'] + $note2[0]['note']) / 2;

        $result = [
            'intituler' => $note1[0]['intituler'],
            'note_seq'.$sequence[0]['num_sequences'] => $note1[0]['note'],
            'note_seq'.$sequence[1]['num_sequences'] => $note2[0]['note'],
            'note_trim'.$trim => $note_calculer,
        ];

        return $result;
    }

    public static function tousTrimestre($eleve, $matiere)
    {
        $alltrims = Trimestre::get(['trimestres.id as trim','trimestres.num_trimestre as num_trim'])->toArray();
        // dd($alltrims[1]['trim']);
        // $sequence = Sequence::where('sequences.trimestre_id',$alltrims[0])->get(['sequences.id','sequences.num_sequences'])
        //                         ->toArray();
        // dd($sequence[0]['id']);
        $note1 = Helper::bulletinTrimestre($eleve,$matiere,$alltrims[0]['trim']);

        $note2 = Helper::bulletinTrimestre($eleve,$matiere,$alltrims[1]['trim']);
        // dd($note2);

        $note3 = Helper::bulletinTrimestre($eleve,$matiere,$alltrims[2]['trim']);


        $note_calculer = ($note1['note_trim'.$alltrims[0]['trim']] + $note2['note_trim'.$alltrims[1]['trim']] + $note3['note_trim'.$alltrims[2]['trim']]) / 3;

        $result = [
            'intituler' => $note1['intituler'],
            'note_trim_1' => $note1['note_trim'.$alltrims[0]['trim']],
            'note_trim_2' => $note2['note_trim'.$alltrims[1]['trim']],
            'note_trim_3' => $note3['note_trim'.$alltrims[2]['trim']],
            'note_annuel' => $note_calculer,
        ];

        return $result;
    }


    public static function moyenneAnnuel($eleve,$salle_id)
    {

        $un = [];
        $somme = 0;


        $moyenne = 0;

        // dd($eleve);
        /* --------- les eleves ------------------------ */
        $eleve = Eleve::where('eleves.classe_id', $salle_id)
                        ->where('eleves.id', $eleve)
                        ->get('id')->toArray();

        /*---------- les trimestres --------------------- */
        $alltrim = Trimestre::get(['num_trimestre'])->toArray();
        // dd($eleve[0]['id']);
        if (!empty($eleve)) {

            /*------------ tous les notes trimestriel d'un eleve --------- */

                # code...
                for ($i = 0; $i <= count($alltrim) - 1; $i++) {
                    # code...
                    // dd($eleve);
                    $trims = Helper::trimestre($eleve[0]['id'], $alltrim[$i]['num_trimestre']);
                    // dd($trims);
                    $somme = $somme + $trims[0]['moyenne_trim'.($i+1)];
                }

                $un = Helper::trimestre($eleve[0]['id'], $alltrim[0]['num_trimestre']);
                // dump($un);
                $moyenne = $somme / count($alltrim);
                // array_push($moyenes, $moyenne);
                // dd($un[0][0]['nom']);
                $unic = [
                    "eleve_id" => $eleve[0]['id'],
                    "nom" => $un[0]['nom'],
                    "prenom" => $un[0]['prenom'],
                    "date_naissance" => $un[0]['date_naissance'],
                    "lieu_naissance" => $un[0]['lieu_naissance'],
                    "genre" => $un[0]['genre'],
                    "moyenne_annuel" => $moyenne,
                    "appreciation" => Helper::apprciation($moyenne),
                ];

            return $unic;
        }
        else
        {
            return response()->json(["message" => " soit les sequences pour ce trimestre n'exite pas soit la classe n"]);
        }
    }
}
