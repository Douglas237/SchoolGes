<?php

namespace App\Http\Controllers\Api;

use App\Models\Enseignant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EnseignantStoreRequest;

class EnseignantController extends Controller
{
    public function index()
    {
        //All Product
        $enseignants = Enseignant::all();
        // Return Json Response

        return response()->json([
            'enseignants' => $enseignants
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnseignantStoreRequest $request)
    {
        // dd($request);

        try {
            $imageName = Str::random(32) . "." . $request->IMAGE->getClientOriginalExtension();
            //create product
            Enseignant::create([
                'NOM' => $request->NOM,
                'PRENOM' => $request->PRENOM,
                'DATE_NAISSANCE' => $request->DATE_NAISSANCE,
                'REGION_ORIGINE' => $request->REGION_ORIGINE,
                'LIEU_NAISSANCE' => $request->LIEU_NAISSANCE,
                'ADRESSE' => $request->ADRESSE,
                'CNI' => $request->CNI,
                'VILLE_RESIDENCE' => $request->VILLE_RESIDENCE,
                'PAYS' => $request->PAYS,
                'TELEPHONE' => $request->TELEPHONE,
                'EMAIL' => $request->EMAIL,
                'IMAGE' => $imageName,
                'SEXE' => $request->SEXE,
                'id_typeEnseignant' => $request->id_typeEnseignant,
                'id_matiere' => $request->id_matiere,
                'description' => $request->description,
            ]);
            //ave image in storage folder
            Storage::disk('public')->put($imageName, file_get_contents($request->IMAGE));

            //Return Json Response
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Enseignant a ete Ajoute avec success!!!!!.',
            ]);
        } catch (\Exception $e) {
            //response json
            return response()->json([
                'message' => 'something went really wrong!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //product details
        $enseignants = Enseignant::find($id);
        if (!$enseignants) {
            return response()->json([
                'message' => 'Personne Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'enseignants' => $enseignants
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //enseignants details
        $enseignants = Enseignant::find($id);
        if (!$enseignants) {
            return response()->json([
                'message' => 'enseignants Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'enseignants' => $enseignants
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnseignantStoreRequest $request,$id)
    {

        try {
            //Find enseignants
            $enseignants = Enseignant::find($id);
            if (!$enseignants) {
                return response()->json([
                    'mesage' => 'Enseignant Not Found'
                ], 404);
            }
            $enseignants->NOM = $request->NOM;
            $enseignants->PRENOM = $request->PRENOM;
            $enseignants->DATE_NAISSANCE = $request->DATE_NAISSANCE;
            $enseignants->REGION_ORIGINE = $request->REGION_ORIGINE;
            $enseignants->LIEU_NAISSANCE = $request->LIEU_NAISSANCE;
            $enseignants->ADRESSE = $request->ADRESSE;
            $enseignants->CNI = $request->CNI;
            $enseignants->VILLE_RESIDENCE = $request->VILLE_RESIDENCE;
            $enseignants->PAYS = $request->PAYS;
            $enseignants->TELEPHONE = $request->TELEPHONE;
            $enseignants->EMAIL = $request->EMAIL;
            $enseignants->SEXE = $request->SEXE;
            $enseignants->id_typeEnseignant = $request->id_typeEnseignant;
            $enseignants->id_matiere = $request->id_matiere;
            $enseignants->description = $request->description;
            if ($request->IMAGE) {
                //pulbic storage
                $storage = Storage::disk('public');
                //old IMAGE delete
                if ($storage->exists($enseignants->IMAGE))
                    $storage->delete($enseignants->IMAGE);

                //Image Name
                $imageName = Str::random(32).".".$request->IMAGE->getClientOriginalExtension();
                $enseignants->IMAGE = $imageName;
                //Image save in public folder

                $storage->put($imageName, file_get_contents($request->IMAGE));
            }

            //update enseignants

            $enseignants->save();

            //return json response

            return response()->json([
                'message' => 'enseignants Successfully Updated.'
            ], 200);
        } catch (\Exception $e) {
            //ReturnJson  Response

            return response()->json([
                'message' => 'Something went really wrong!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Detail
        $enseignants = Enseignant::find($id);
        if (!$enseignants) {
            return response()->json([
                'message' => 'enseignants Not Found.'
            ], 404);
        }

        //pulbic storage
        $storage = Storage::disk('public');
        //image delete
        if ($storage->exists($enseignants->IMAGE))
            $storage->delete($enseignants->IMAGE);

            //Delete Product
            $enseignants->delete();

            //Return Json Response
            return response()->json([
                'message'=> 'enseignants successfully deleted'
            ],200);
    }
}
