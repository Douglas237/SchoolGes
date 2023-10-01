<?php

namespace App\Http\Controllers\Api;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Sequence;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BulletinRequest;
use App\Http\Requests\BulletinTrimestreRequest;

class BulletinController extends Controller
{
    public function sequence(BulletinRequest $request)
    {
        $lesmatieres = [];

        $eleve = Eleve::where('eleves.id',$request->eleve_id)
                        ->get(['eleves.id as eleve'])
                        ->toArray();

        $sequence = Sequence::where('sequences.id',$request->sequence)
                            ->get(['sequences.id as sequence'])
                            ->toArray();

        $matieres = Classe::join('matieres','matieres.classe_id','=','classes.id')
                            ->where('matieres.classe_id',$request->classe_id)
                            ->get(['matieres.id as matiere'])
                            ->toArray();

        // dd($matieres);
        for ($i=0; $i <= count($matieres) - 1; $i++) {
            # code...
            $unematiere = Helper::bulletinSequence($eleve[0]['eleve'],$matieres[$i]['matiere'],$sequence[0]['sequence']);

            array_push($lesmatieres, $unematiere);
        }

        $donneseq = Helper::moyennesequentiel($eleve[0]['eleve'], $sequence[0]['sequence']);
        // dd($donneseq[0]);
        return response()->json([
            "type" => "sequence",
            "note" => $lesmatieres,
            "totale_points" => $donneseq[0]['totale_points'],
            "moyenne" => $donneseq[0]['moyenne'],
            "appreciation" => $donneseq[0]['appreciation'],
        ]);
    }

    public function trimestre(BulletinTrimestreRequest $request)
    {
        $lesnotestrims = [];

        $eleve = Eleve::where('eleves.id',$request->eleve_id)
                        ->get(['eleves.id as eleve'])
                        ->toArray();


        $matieres = Classe::join('matieres','matieres.classe_id','=','classes.id')
                                ->where('matieres.classe_id',$request->classe_id)
                                ->get(['matieres.id as matiere'])
                                ->toArray();
        // dd($matieres);
        for ($i=0; $i <= count($matieres) - 1; $i++) {
            # code...
            $unematiere = Helper::bulletinTrimestre($eleve[0]['eleve'],$matieres[$i]['matiere'],$request->trimestre_id);

            array_push($lesnotestrims, $unematiere);
        }

        $donneseq = Helper::trimestre($eleve[0]['eleve'], $request->trimestre_id);
        // dd($donneseq[0]);
        return response()->json([
            "type" => "trimestre",
            "note" => $lesnotestrims,
            "totale_points" => $donneseq[0]['somme_point_trim'],
            "moyenne" => $donneseq[0]['moyenne_trim1'],
            "appreciation" => $donneseq[0]['appreciation'],
        ]);
    }

    public function annuel(Request $request)
    {
        $lesnotestrims = [];

        // $alltrims = Trimestre::get(['trimestres.id','trimestres.num_trimestre'])->toArray();

        $eleve = Eleve::where('eleves.id',$request->eleve_id)
                        ->get(['eleves.id as eleve'])
                        ->toArray();

        // dd($eleve[0]['eleve']);
        // dd($donneseq);
        $matieres = Classe::join('matieres','matieres.classe_id','=','classes.id')
                            ->where('matieres.classe_id',$request->classe_id)
                            ->get(['matieres.id as matiere'])
                            ->toArray();

        // dd($matieres);
        for ($i=0; $i <= count($matieres) - 1; $i++)
        {
            # code...
            $unematiere = Helper::tousTrimestre($eleve[0]['eleve'],$matieres[$i]['matiere']);
            // dd($unematiere);
            array_push($lesnotestrims, $unematiere);
        }

        $donneseq = Helper::moyenneAnnuel($eleve[0]['eleve'], $request->classe_id);
        return response()->json([
            "type" => "annuel",
            "note" => $lesnotestrims,
            "moyenne" => $donneseq['moyenne_annuel'],
            "appreciation" => $donneseq['appreciation'],
        ]);
    }
}
