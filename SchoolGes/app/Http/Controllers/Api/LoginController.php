<?php

namespace App\Http\Controllers\Api;

use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SuperAdminResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // dd(Auth::guard('admins_circonscription')->attempt($request->only('email','password')));
        // if (! Auth::guard('admins_circonscription')->attempt($request->only('email','password'))) {
        //     # code...
        //     Helper::sendError("email or password is wrong");
        // }
        // $user = Admincirconscription::where('email', $request->email)->first();
        if ( $adminc = Auth::guard('admins_circonscription')->attempt($request->only('email','password'))) {
            // dd($adminc);
            $user = Auth::guard('admins_circonscription')->user();
            return response()->json([
                'token' => $adminc,
                'user' => UserResource::make($user),
            ]);
        }
        elseif ( $adminc = Auth::guard('chef_etablissement')->attempt($request->only('email','password'))) {

            $user = Auth::guard('chef_etablissement')->user();
            return response()->json([
                'token' => $adminc,
                'user' => UserResource::make($user),
            ]);
        }
        elseif ( $adminc = Auth::guard('superadmin')->attempt($request->only('email','password'))) {

            $user = Auth::guard('superadmin')->user();
            return response()->json([
                'token' => $adminc,
                'user' => SuperAdminResource::make($user),
            ]);
        }
        Helper::sendError("email or password is wrong");
        // dd(Auth::guard('admins_circonscription')->user());
    }
}
