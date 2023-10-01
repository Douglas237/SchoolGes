<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Circoncription
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard)
    {
        // dd(Auth::guard('admins_circonscription')->user());
        if (Auth::guard($guard)->user()) {
            # code...
            return $next($request);
        }
        return response()->json(['message' => ' log in please ']);
    }
}
