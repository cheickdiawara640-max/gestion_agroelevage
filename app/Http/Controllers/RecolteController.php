<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recolte;
use App\Models\Parcelle;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RecolteExport;

class RecolteController extends Controller
{
    // Liste des récoltes
    public function index()
    {
        $recoltes = Recolte::with('parcelle')->orderBy('id', 'desc')->get();
        return view('recoltes.index', compact('recoltes'));
    }

    // Formulaire de création
    public function create()
    {
        $parcelles = Parcelle::all();
        return view('recoltes.create', compact('parcelles'));
    }

    // Stocker une nouvelle récolte
    public function store(Request $request)
    {
        $request->validate([
            'parcelle_id' => 'required|exists:parcelles,id',
            'culture' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'date_recolte' => 'required|date',
            'remarques' => 'nullable|string|max:255',
        ]);

        Recolte::create($request->only(['parcelle_id','culture','quantite','date_recolte','remarques']));

        return redirect()->route('recoltes.index')->with('success','Récolte ajoutée.');
    }

    // Formulaire d'édition
    public function edit(Recolte $recolte)
    {
        $parcelles = Parcelle::all();
        return view('recoltes.edit', compact('recolte','parcelles'));
    }

    // Mettre à jour une récolte
    public function update(Request $request, Recolte $recolte)
    {
        $request->validate([
            'parcelle_id' => 'required|exists:parcelles,id',
            'culture' => 'required|string|max:255',
            'quantite' => 'required|numeric',
            'date_recolte' => 'required|date',
            'remarques' => 'nullable|string|max:255',
        ]);

        $recolte->update($request->only(['parcelle_id','culture','quantite','date_recolte','remarques']));

        return redirect()->route('recoltes.index')->with('success','Récolte modifiée.');
    }

    // Supprimer une récolte
    public function destroy(Recolte $recolte)
    {
        $recolte->delete();
        return redirect()->route('recoltes.index')->with('success','Récolte supprimée.');
    }

    // Export PDF
    public function exportPdf()
    {
        $recoltes = Recolte::with('parcelle')->orderBy('id','desc')->get();
        $fields = ['id','parcelle_id','culture','quantite','date_recolte','remarques'];

        $pdf = PDF::loadView('recoltes.pdf', compact('recoltes','fields'));
        return $pdf->download('recoltes.pdf');
    }

    // Export Excel
    public function exportExcel()
    {
        return Excel::download(new RecolteExport, 'recoltes.xlsx');
    }
}
