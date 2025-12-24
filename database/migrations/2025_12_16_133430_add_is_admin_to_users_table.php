<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Import nécessaire

class AdminMiddleware
{
    /**
     * Gère une requête entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Vérifie si l'utilisateur est connecté
        if (Auth::check()) {
            
            // 2. Vérifie si l'utilisateur est administrateur (utilise la méthode isAdmin() du modèle User)
            if (Auth::user()->isAdmin()) {
                return $next($request); // Laisse l'utilisateur passer au Dashboard
            }
            
            // Si l'utilisateur est connecté mais n'est PAS admin
            return redirect('/home')->with('error', 'Accès refusé. Vous devez être administrateur pour accéder à cette ressource.');
        }
        
        // Si l'utilisateur n'est pas connecté du tout, il est renvoyé à la page de connexion
        return redirect('/login');
    }
}