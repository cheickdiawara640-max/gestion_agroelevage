<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ✅ Assure-toi que le Controller de base est importé
use App\Models\Culture;
use App\Models\Parcelle;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CultureExport;

class CultureController extends Controller
{
    public function index()
    {
        $cultures = Culture::with('parcelle')->get();
        return view('cultures.index', compact('cultures'));
    }

    public function create()
    {
        $parcelles = Parcelle::all();
        return view('cultures.create', compact('parcelles'));
    }

    public function edit(Culture $culture)
    {
        $parcelles = Parcelle::all();
        return view('cultures.edit', compact('culture', 'parcelles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'periode_semis' => 'required|date',
            'periode_recolte' => 'required|date',
            'parcelle_id' => 'required|exists:parcelles,id',
        ]);

        Culture::create($request->only(['nom','type','periode_semis','periode_recolte','parcelle_id']));

        return redirect()->route('cultures.index')
            ->with('success', 'Culture ajoutée avec succès !');
    }

    public function update(Request $request, Culture $culture)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'periode_semis' => 'required|date',
            'periode_recolte' => 'required|date',
            'parcelle_id' => 'required|exists:parcelles,id',
        ]);

        $culture->update($request->only(['nom','type','periode_semis','periode_recolte','parcelle_id']));

        return redirect()->route('cultures.index')
            ->with('success', 'Culture modifiée avec succès !');
    }

    public function destroy(Culture $culture)
    {
        $culture->delete();
        return redirect()->route('cultures.index')->with('success','Culture supprimée.');
    }

    // ====================== EXPORT PDF ======================
    public function exportPdf()
    {
        $cultures = Culture::with('parcelle')->orderBy('id','desc')->get();
        $fields = ['id','nom','type','periode_semis','periode_recolte','parcelle_id'];

        $pdf = PDF::loadView('cultures.pdf', compact('cultures','fields'));
        return $pdf->download('cultures.pdf');
    }

    // ====================== EXPORT EXCEL ======================
    public function exportExcel()
    {
        return Excel::download(new CultureExport, 'cultures.xlsx');
    }
}
