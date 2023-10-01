<?php

namespace App\Http\Controllers\Api;

use App\Models\ParentE;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ParentStoreRequest;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
    public function index()
    {
        //All Product
        $Parents = ParentE::all();
        // Return Json Response

        return response()->json([
            'Parents' => $Parents
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_parent' => 'required',
            'telephone' => 'required',
            'CNI' => 'required',
            'email' => 'required',
            'lieu_residence' => 'required',
            'photo' => 'required',
            'user_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 500,
                'status_message' => 'Veillez verifier tous les champs😢😢😢😢.',
            ]);
        }

        try {
            $imageName = $request->user_name . "." . $request->photo->getClientOriginalExtension();
            //create product
            ParentE::create([
                'code_parent' => $request->code_parent,
                'telephone' => $request->telephone,
                'CNI' => $request->CNI,
                'email' => $request->email,
                'lieu_residence' => $request->lieu_residence,
                'photo' => $imageName,
                'user_name' => $request->user_name,
            ]);
            //ave image in storage folder
            Storage::disk('public')->put($imageName, file_get_contents($request->photo));

            //Return Json Response
            //Return Json Response
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Parent a ete Ajoute avec success❤❤❤❤❤❤❤❤🤑🤑🤑🤑🤑!!!!!.',
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
        $Parents = ParentE::find($id);
        if (!$Parents) {
            return response()->json([
                'message' => 'Parent Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'Parents' => $Parents
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Parents details
        $Parents = ParentE::find($id);
        if (!$Parents) {
            return response()->json([
                'message' => 'Parents Not Found.'
            ], 404);
        }

        //Return Json Response

        return response()->json([
            'Parents' => $Parents
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        try {
            //Find Parents
            $Parents = ParentE::find($id);
            if (!$Parents) {
                return response()->json([
                    'mesage' => 'Produit Not Found'
                ], 404);
            }
            $Parents->code_parent = $request->code_parent;
            $Parents->telephone = $request->telephone;
            $Parents->CNI = $request->CNI;
            $Parents->email = $request->email;
            $Parents->lieu_residence = $request->lieu_residence;
            $Parents->user_name = $request->user_name;
            if ($request->IMAGE) {
                //pulbic storage
                $storage = Storage::disk('public');
                //old IMAGE delete
                if ($storage->exists($Parents->photo))
                    $storage->delete($Parents->photo);

                //Image Name
                $imageName = $request->user_name.".".$request->photo->getClientOriginalExtension();
                $Parents->photo = $imageName;
                //Image save in public folder

                $storage->put($imageName, file_get_contents($request->photo));
            }

            //update Parents

            $Parents->save();

            //return json response

            return response()->json([
                'message' => 'Parents Successfully Updated.'
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
        $Parents = ParentE::find($id);
        if (!$Parents) {
            return response()->json([
                'message' => 'Parents Not Found.'
            ], 404);
        }

        //pulbic storage
        $storage = Storage::disk('public');
        //image delete
        if ($storage->exists($Parents->photo))
            $storage->delete($Parents->photo);

            //Delete Product
            $Parents->delete();

            //Return Json Response
            return response()->json([
                'message'=> 'Parents successfully deleted'
            ],200);
    }
}
