<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // On vérifie si l'utilisateur est connecté ET s'il est admin
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // Sinon, redirection vers home avec un message
       return redirect('/')->with('error', 'Accès refusé.'); 
    }
}
