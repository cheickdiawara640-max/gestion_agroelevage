<?php

namespace App\Http\Controllers;

use App\Models\Traitement;
use App\Models\Culture;
use App\Models\Parcelle;
use Illuminate\Http\Request;

// Imports nécessaires pour l'exportation
use PDF; // Librairie pour l'export PDF (Dompdf)
use Maatwebsite\Excel\Facades\Excel; // Librairie pour l'export Excel
use App\Exports\TraitementsExport; // La classe d'export personnalisée

class TraitementController extends Controller
{
    // =======================================================
    // I. CRUD - Create, Read, Update, Delete (Gestion des données)
    // =======================================================

    /**
     * Affiche une liste des traitements (READ - Index).
     * Récupère tous les traitements avec les relations et la pagination.
     */
    public function index()
    {
        $traitements = Traitement::with(['culture', 'parcelle'])->latest()->paginate(10);
        return view('traitements.index', compact('traitements'));
    }

    /**
     * Affiche le formulaire de création de traitement (CREATE - Form).
     * Prépare les données nécessaires aux listes déroulantes.
     */
    public function create()
    {
        $cultures = Culture::all();
        $parcelles = Parcelle::all();
        return view('traitements.create', compact('cultures', 'parcelles'));
    }

    /**
     * Stocke un nouveau traitement dans la base de données (CREATE - Store).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'type_produit' => 'required|string|max:100',
            'dose' => 'required|numeric|min:0',
            'unite_dose' => 'required|string|max:10',
            'date_application' => 'required|date',
            'culture_id' => 'nullable|exists:cultures,id',
            'parcelle_id' => 'nullable|exists:parcelles,id',
        ]);

        Traitement::create($request->all());

        return redirect()->route('traitements.index')
                         ->with('success', 'Le traitement a été enregistré avec succès.');
    }

    /**
     * Affiche les détails d'un traitement (READ - Show).
     */
    public function show(Traitement $traitement)
    {
        return view('traitements.show', compact('traitement'));
    }

    /**
     * Affiche le formulaire d'édition d'un traitement (UPDATE - Form).
     * Prépare les données nécessaires aux listes déroulantes.
     */
    public function edit(Traitement $traitement)
    {
        $cultures = Culture::all();
        $parcelles = Parcelle::all();
        return view('traitements.edit', compact('traitement', 'cultures', 'parcelles'));
    }

    /**
     * Met à jour le traitement spécifié dans la base de données (UPDATE - Store).
     */
    public function update(Request $request, Traitement $traitement)
    {
        $request->validate([
            'nom_produit' => 'required|string|max:255',
            'type_produit' => 'required|string|max:100',
            'dose' => 'required|numeric|min:0',
            'unite_dose' => 'required|string|max:10',
            'date_application' => 'required|date',
            'culture_id' => 'nullable|exists:cultures,id',
            'parcelle_id' => 'nullable|exists:parcelles,id',
        ]);

        $traitement->update($request->all());

        return redirect()->route('traitements.index')
                         ->with('success', 'Le traitement a été mis à jour.');
    }

    /**
     * Supprime le traitement de la base de données (DELETE - Destroy).
     */
    public function destroy(Traitement $traitement)
    {
        $traitement->delete();

        return redirect()->route('traitements.index')
                         ->with('success', 'Le traitement a été supprimé.');
    }


    // =======================================================
    // II. EXPORTS
    // =======================================================

    /**
     * Exporte la liste complète des traitements au format Excel (XLSX).
     */
    public function exportExcel()
    {
        return Excel::download(new TraitementsExport, 'traitements_liste.xlsx');
    }

    /**
     * Exporte la liste complète des traitements au format PDF.
     */
    public function exportPdfListe()
    {
        $traitements = Traitement::with(['culture', 'parcelle'])->get();
        
        $pdf = PDF::loadView('traitements.pdf_liste', compact('traitements'))
                  // A4 en paysage pour maximiser l'affichage des colonnes
                  ->setPaper('a4', 'landscape'); 

        return $pdf->download('traitements_liste.pdf');
    }
}