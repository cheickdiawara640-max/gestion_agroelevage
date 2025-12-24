<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use Illuminate\Http\Request;
use PDF; // Pour l'export PDF, via barryvdh/laravel-dompdf
use Maatwebsite\Excel\Facades\Excel; // Pour l'export Excel, via maatwebsite/excel
use App\Exports\BesoinExport; // Classe d'export à créer pour Excel

class BesoinController extends Controller
{
    // Afficher tous les besoins
    public function index()
    {
        $besoins = Besoin::all();
        return view('besoins.index', compact('besoins'));
    }

    // Formulaire création
    public function create()
    {
        return view('besoins.create');
    }

    // Enregistrer un nouveau besoin
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'montant' => 'required|numeric',
            'date_demande' => 'required'
        ]);

        Besoin::create($request->all());

        return redirect()->route('besoins.index')->with('success', 'Besoin ajouté');
    }

    // Formulaire édition
    public function edit($id)
    {
        $besoin = Besoin::findOrFail($id);
        return view('besoins.edit', compact('besoin'));
    }

    // Mettre à jour un besoin
    public function update(Request $request, $id)
    {
        $besoin = Besoin::findOrFail($id);
        $besoin->update($request->all());
        return redirect()->route('besoins.index')->with('success', 'Modifié');
    }

    // Supprimer un besoin
    public function destroy($id)
    {
        Besoin::findOrFail($id)->delete();
        return redirect()->route('besoins.index')->with('success', 'Supprimé');
    }

    // Export PDF
    public function exportPdf()
    {
        $besoins = Besoin::all();
        $pdf = PDF::loadView('besoins.pdf', compact('besoins')); // Créer la vue besoins/pdf.blade.php
        return $pdf->download('besoins.pdf');
    }

    // Export Excel
    public function exportExcel()
    {
        return Excel::download(new BesoinExport, 'besoins.xlsx'); // Créer l'export BesoinExport
    }
}
