<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Arrays;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        foreach ($request->notes as $data) {

            Note::create(
                [
                    "enseignant_id" => $data['enseignant_id'],
                    "matiere_id" => $data['matiere_id'],
                    "sequence_id" => $data['sequence_id'],
                    "eleve_id" => $data['eleve_id'],
                    "trimestre_id" => $data['trimestre_id'],
                    "classe_id" => $data['classe_id'],
                    "salleclasse_id" => $data['salleclasse_id'],
                    "note" => $data['note'],
                ]
            );
        }

        return response()->json([
            'message' => 'insertion avec succes',
        ]);
    }
}
