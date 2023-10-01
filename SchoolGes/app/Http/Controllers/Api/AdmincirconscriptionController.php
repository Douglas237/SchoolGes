<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Etablissement;
use App\Models\Chefetablissement;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Admincirconscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\EtablissementResource;
use App\Http\Requests\StoreChefetablissementRequest;
use App\Http\Requests\StoreAdminCirconscriptionRequest;

class AdmincirconscriptionController extends Controller
{

    public function chefEtablissement(StoreChefetablissementRequest $request)
    {
        $nom = str_replace(' ', '', $request->name);
        $imageName = trim($nom) . "." . $request->image->getClientOriginalExtension();
        $newChef = Chefetablissement::create([
            "name" => $request->name,
            "prenom" => $request->prenom,
            "date_naissance" => $request->date_naissance,
            "lieu_naissance" => $request->lieu_naissance,
            "region_naissance" => $request->region_naissance,
            "cni" => $request->cni,
            "ville_residence" => $request->ville_residence,
            "pays" => $request->pays,
            "telephone" => $request->telephone,
            "adresse" => $request->adresse,
            "image" => $imageName,
            "sexe" => $request->sexe,
            "description" => $request->description,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "admincirconscription_id" => Auth::guard('admins_circonscription')->user()->id,
        ]);
        $rolChef = Role::firstOrCreate(['name' => 'chef_etablissement','guard_name' => 'chef_etablissement']);
        $newChef->assignRole($rolChef);

        Storage::disk("chefetablissements")->put($imageName, file_get_contents($request->image));
        return new UserResource($newChef);
    }

    public function alletablissement()
    {
        $admin_id = Auth::guard('admins_circonscription')->user()->id;
        $etablissements = Etablissement::where('admincirconscription_id',$admin_id)->get();
        return EtablissementResource::collection($etablissements);
    }

    public function list()
    {
        $admin_id = Auth::guard('admins_circonscription')->user()->id;
        $chef = Chefetablissement::where('admincirconscription_id',$admin_id)->get();
        return UserResource::collection($chef);
    }

    public function showEtablissement()
    {
        $admin_id = Auth::guard('admins_circonscription')->user()->id;
        $etablissements = Etablissement::where('admincirconscription_id', $admin_id)->get();

        return EtablissementResource::collection($etablissements);
    }

    // creation d'un admin circonscription
    public function store(StoreAdminCirconscriptionRequest $request)
    {

            $nom = str_replace(' ', '', $request->name);
            $imageName = trim($nom) . "." . $request->image->getClientOriginalExtension();
            $admin = Admincirconscription::create([
                "name" => $request->name,
                "prenom" => $request->prenom,
                "date_naissance" => $request->date_naissance,
                "lieu_naissance" => $request->lieu_naissance,
                "region_naissance" => $request->region_naissance,
                "cni" => $request->cni,
                "ville_residence" => $request->ville_residence,
                "pays" => $request->pays,
                "telephone" => $request->telephone,
                "adresse" => $request->adresse,
                "image" => $imageName,
                "sexe" => $request->sexe,
                "description" => $request->description,
                "email" => $request->email,
                "password" => bcrypt($request->password),
            ]);

            $roladmin = Role::firstOrCreate(['name' => 'admins_circonscription','guard_name' => 'admins_circonscription']);
            $admin->assignRole($roladmin);
            //dd($imageName);

            Storage::disk("admincirconscriptions")->put($imageName, file_get_contents($request->image));

            return response()->json([
                'success' => true,
                'message' => 'enrolled successfully',
                'data' => $admin
            ]);

    }

    // modification d'un administrateur de circonscription
    public function update(StoreAdminCirconscriptionRequest $request, $id)
    {
        try {
            $admin = Admincirconscription::find($id);
            //dd($admin);

            $admin->name = $request->name;
            $admin->prenom = $request->prenom;
            $admin->date_naissance = $request->date_naissance;
            $admin->lieu_naissance = $request->lieu_naissance;
            $admin->region_naissance = $request->region_naissance;
            $admin->cni = $request->cni;
            $admin->ville_residence = $request->ville_residence;
            $admin->pays = $request->pays;
            $admin->telephone = $request->telephone;
            $admin->adresse = $request->adresse;
            $admin->sexe = $request->sexe;
            $admin->description = $request->description;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            if($request->image)
            {
                $storage = Storage::disk('admincirconscriptions');
                if($storage->exists($admin->image))
                $storage->delete($admin->image);

                $imageName = $request->name.".".$request->image->getClientOriginalExtension();
                $admin->image = $imageName;

                $storage->put($imageName, file_get_contents($request->image));

                $admin->save();

                return response()->json([
                    'statut_message' => 'admin modifier avec succes'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    // listing de tous les admins circonscriptions

    public function index()
    {
        try {

            $admin = Admincirconscription::all();
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'liste des admininstrateur de circonscriptions',
                'data' => $admin,
            ]);

        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

        // afficher les informations d'un admin
        public function show($id)
        {
            try {
                if ($id) {
                    $admin = Admincirconscription::find($id);
                    return response()->json([
                        'status_message' => 'detail de cet admini',
                        'data' => $admin
                    ]);
                } else {

                    return response()->json([
                        'status_code' => 422,
                        'status_message' => 'admin non existant'
                    ]);
                }
            } catch (Exception $e) {
                return response()->json($e);
            }
        }

            // supprimer un administrateur
    public  function destroy($id)
    {
        try {
            if ($id) {
                $admin = Admincirconscription::find($id);
                $admin->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => 'administrateur supprimer',
                    'data' => $admin
                ]);
            } else {
                return response()->json([
                    'status_code' => 422,
                    'status_message' => 'administrateur introuvable'
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
