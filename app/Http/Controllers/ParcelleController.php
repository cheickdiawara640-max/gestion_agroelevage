<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // ✅ Import du Controller de base
use App\Models\Parcelle;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParcelleExport;

class ParcelleController extends Controller
{
    public function index()
    {
        $parcelles = Parcelle::all();
        return view('parcelles.index', compact('parcelles'));
    }

    public function create()
    {
        return view('parcelles.create');
    }

    public function edit(Parcelle $parcelle)
    {
        return view('parcelles.edit', compact('parcelle'));
    }
    public function show(Parcelle $parcelle) {
    // On charge les cultures liées à cette parcelle
    $cultures = $parcelle->cultures()->orderBy('id', 'desc')->get();
    return view('parcelles.show', compact('parcelle', 'cultures'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'superficie' => 'required|numeric',
            'localisation' => 'nullable|string|max:255',
        ]);

        Parcelle::create($request->only(['nom','superficie','localisation']));

        return redirect()->route('parcelles.index')->with('success','Parcelle ajoutée.');
    }

    public function update(Request $request, Parcelle $parcelle)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'superficie' => 'required|numeric',
            'localisation' => 'nullable|string|max:255',
        ]);

        $parcelle->update($request->only(['nom','superficie','localisation']));

        return redirect()->route('parcelles.index')->with('success','Parcelle modifiée.');
    }

    public function destroy(Parcelle $parcelle)
    {
        $parcelle->delete();
        return redirect()->route('parcelles.index')->with('success','Parcelle supprimée.');
    }

    // ====================== EXPORT PDF ======================
    public function exportPdf()
    {
        $parcelles = Parcelle::orderBy('id','desc')->get();
        $fields = ['id','nom','superficie','localisation'];

        $pdf = PDF::loadView('parcelles.pdf', compact('parcelles','fields'));
        return $pdf->download('parcelles.pdf');
    }

    // ====================== EXPORT EXCEL ======================
    public function exportExcel()
    {
        return Excel::download(new ParcelleExport, 'parcelles.xlsx');
    }
}
