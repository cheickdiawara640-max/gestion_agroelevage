<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Appliquer le middleware admin à toutes les méthodes
     */
  

    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistre l'utilisateur
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Formulaire d'édition
     */
    public function edit(User $user)
    {
        // On vérifie si l'utilisateur connecté est bien admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('users.index')->with('error', 'Accès refusé.');
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Mise à jour de l'utilisateur
     */
    public function update(Request $request, User $user)
    {
        // Correction de la syntaxe (ajout des parenthèses autour du if)
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('users.index')->with('error', 'Accès refusé.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'is_admin' => 'required|boolean',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Suppression
     */
    public function destroy(User $user)
    {
        // Protection : ne pas se supprimer soi-même
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', "L'utilisateur {$user->name} a été supprimé.");
    }
}
