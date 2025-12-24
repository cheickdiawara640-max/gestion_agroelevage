<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Recolte; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

// Imports nécessaires pour l'exportation
use PDF; 
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\VentesExport; 

class VenteController extends Controller
{
    // =======================================================
    // I. CRUD - Create, Read, Update, Delete (Gestion des données)
    // =======================================================

    /**
     * Affiche une liste des ventes (READ - Index).
     */
    public function index()
    {
        // Récupère toutes les ventes avec la récolte liée, triées par date et paginées
        $ventes = Vente::with('recolte')->latest('date_vente')->paginate(10);
        return view('ventes.index', compact('ventes'));
    }

    /**
     * Affiche le formulaire de création de vente (CREATE - Form).
     */
    public function create()
    {
        // Récupère les récoltes disponibles pour lier la vente
        $recoltes = Recolte::all();
        return view('ventes.create', compact('recoltes'));
    }

    /**
     * Stocke une nouvelle vente dans la base de données (CREATE - Store).
     */
    public function store(Request $request)
    {
        $request->validate([
            'recolte_id' => 'required|exists:recoltes,id',
            'date_vente' => 'required|date',
            'produit_vendu' => 'required|string|max:255',
            'quantite_vendue' => 'required|numeric|min:0',
            'unite_quantite' => 'required|string|max:10',
            'prix_unitaire' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'mode_vente' => 'required|string|max:100',
            'mode_paiement' => 'nullable|string|max:100',
            'client_nom' => 'nullable|string|max:255',
        ]);

        // Utiliser une transaction pour assurer l'intégrité
        DB::transaction(function () use ($request) {
            Vente::create($request->all());

            // LOGIQUE DE STOCK OPTIONNELLE (exemple) : 
            // $recolte = Recolte::find($request->recolte_id);
            // $recolte->quantite_restante -= $request->quantite_vendue;
            // $recolte->save();
        });


        return redirect()->route('ventes.index')
                         ->with('success', 'La vente a été enregistrée avec succès.');
    }

    /**
     * Affiche les détails d'une vente (READ - Show).
     */
    public function show(Vente $vente)
    {
        return view('ventes.show', compact('vente'));
    }

    /**
     * Affiche le formulaire d'édition (UPDATE - Form).
     */
    public function edit(Vente $vente)
    {
        $recoltes = Recolte::all();
        return view('ventes.edit', compact('vente', 'recoltes'));
    }

    /**
     * Met à jour la vente spécifiée (UPDATE - Store).
     */
    public function update(Request $request, Vente $vente)
    {
        $request->validate([
            'recolte_id' => 'required|exists:recoltes,id',
            'date_vente' => 'required|date',
            'produit_vendu' => 'required|string|max:255',
            'quantite_vendue' => 'required|numeric|min:0',
            'unite_quantite' => 'required|string|max:10',
            'prix_unitaire' => 'required|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
            'mode_vente' => 'required|string|max:100',
            'mode_paiement' => 'nullable|string|max:100',
            'client_nom' => 'nullable|string|max:255',
        ]);

        $vente->update($request->all());

        return redirect()->route('ventes.index')
                         ->with('success', 'La vente a été mise à jour.');
    }

    /**
     * Supprime la vente (DELETE - Destroy).
     */
    public function destroy(Vente $vente)
    {
        $vente->delete();

        return redirect()->route('ventes.index')
                         ->with('success', 'La vente a été supprimée.');
    }
    
    // =======================================================
    // II. EXPORTS
    // =======================================================

    /**
     * Exporte la liste complète des ventes au format Excel (XLSX).
     */
    public function exportExcel()
    {
        return Excel::download(new VentesExport, 'journal_des_ventes.xlsx');
    }

    /**
     * Exporte la liste complète des ventes au format PDF.
     */
    public function exportPdfListe()
    {
        $ventes = Vente::with('recolte')->latest('date_vente')->get();
        
        $pdf = PDF::loadView('ventes.pdf_liste', compact('ventes'))
                  // Format A4 en paysage pour plus de colonnes dans un journal de vente
                  ->setPaper('a4', 'landscape'); 

        return $pdf->download('journal_des_ventes.pdf');
    }
}