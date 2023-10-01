<?php

namespace App\Http\Controllers\Api;

use App\Models\Personne;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonneRequest;
use Illuminate\Support\Facades\Storage;

class PersonneController extends Controller
{
    public function index()
    {
        //All Product
        $personnes = Personne::all();
        // Return Json Response

        return response()->json([
            'personnes' => $personnes
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
    public function store(PersonneRequest $request)
    {
        // dd($request);

        try {
            $imageName = $request->NOM . "." . $request->IMAGE->getClientOriginalExtension();
            //create product
            Personne::create([
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
                'description' => $request->description,
            ]);
            //ave image in storage folder
            Storage::disk('public')->put($imageName, file_get_contents($request->IMAGE));

            //Return Json Response
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Personne a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
                'data' => $request
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
        $personnes = Personne::find($id);
        if (!$personnes) {
            return response()->json([
                'message' => 'Personne Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'personnes' => $personnes
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //personnes details
        $personnes = Personne::find($id);
        if (!$personnes) {
            return response()->json([
                'message' => 'personnes Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'personnes' => $personnes
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonneRequest $request,$id)
    {

        try {
            //Find personnes
            $personnes = Personne::find($id);
            if (!$personnes) {
                return response()->json([
                    'mesage' => 'Produit Not Found'
                ], 404);
            }
            $personnes->NOM = $request->NOM;
            $personnes->PRENOM = $request->PRENOM;
            $personnes->DATE_NAISSANCE = $request->DATE_NAISSANCE;
            $personnes->REGION_ORIGINE = $request->REGION_ORIGINE;
            $personnes->LIEU_NAISSANCE = $request->LIEU_NAISSANCE;
            $personnes->ADRESSE = $request->ADRESSE;
            $personnes->CNI = $request->CNI;
            $personnes->VILLE_RESIDENCE = $request->VILLE_RESIDENCE;
            $personnes->PAYS = $request->PAYS;
            $personnes->TELEPHONE = $request->TELEPHONE;
            $personnes->EMAIL = $request->EMAIL;
            $personnes->SEXE = $request->SEXE;
            $personnes->description = $request->description;
            if ($request->IMAGE) {
                //pulbic storage
                $storage = Storage::disk('public');
                //old IMAGE delete
                if ($storage->exists($personnes->IMAGE))
                    $storage->delete($personnes->IMAGE);

                //Image Name
                $imageName = $request->NOM.".".$request->IMAGE->getClientOriginalExtension();
                $personnes->IMAGE = $imageName;
                //Image save in public folder

                $storage->put($imageName, file_get_contents($request->IMAGE));
            }

            //update personnes

            $personnes->save();

            //return json response

            return response()->json([
                'message' => 'personnes Successfully Updated.'
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
        $personnes = Personne::find($id);
        if (!$personnes) {
            return response()->json([
                'message' => 'personnes Not Found.'
            ], 404);
        }

        //pulbic storage
        $storage = Storage::disk('public');
        //image delete
        if ($storage->exists($personnes->IMAGE))
            $storage->delete($personnes->IMAGE);

            //Delete Product
            $personnes->delete();

            //Return Json Response
            return response()->json([
                'message'=> 'Personnes successfully deleted'
            ],200);
    }
}
