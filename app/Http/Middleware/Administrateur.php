<?php

namespace App\Http\Middleware;

use Closure;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Administrateur
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('administrateur')->check()){
            return redirect()->route('administrateur_login')->with('error', 'Vous n\'avez pas accés a cette zone');
        }

        return $next($request);    }
}