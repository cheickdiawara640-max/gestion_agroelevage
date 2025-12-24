<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Affiche la page login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Connexion sans bcrypt
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Rediriger vers le dashboard après succès
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'Les identifiants ne correspondent pas.',
    ])->onlyInput('email');
}
    // Déconnexion
   public function logout(Request $request)
{
    Auth::logout();

    // Détruit la session actuelle
    $request->session()->invalidate();

    // Régénère le jeton CSRF pour plus de sécurité
    $request->session()->regenerateToken();

    // Redirige vers la page de login
    return redirect('/login');
}
}
