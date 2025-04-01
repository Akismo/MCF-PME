<?php

namespace App\Http\Middleware;

use illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Membre
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('membre')->check()){
            return redirect()->route('membre_login')->with('error', 'Vous n\'avez pas accés a cette zone');
        }

        return $next($request);
    }
}
