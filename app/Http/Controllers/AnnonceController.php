<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::latest()->paginate(10);
        return view('annonces.index', compact('annonces'));
    }

    public function create()
    {
        return view('annonces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Annonce::create($request->all());

        return redirect()->route('annonces.index')->with('success', 'Annonce créée avec succès.');
    }

    public function show(Annonce $annonce)
    {
        return view('annonces.show', compact('annonce'));
    }

    public function edit(Annonce $annonce)
    {
        return view('annonces.edit', compact('annonce'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $annonce->update($request->all());

        return redirect()->route('annonces.index')->with('success', 'Annonce mise à jour avec succès.');
    }

    public function destroy(Annonce $annonce)
    {
        $annonce->delete();
        return redirect()->route('annonces.index')->with('success', 'Annonce supprimée avec succès.');
    }
}
