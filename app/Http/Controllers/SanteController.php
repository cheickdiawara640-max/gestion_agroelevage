<?php

namespace App\Http\Controllers;

use App\Models\Sante;
use App\Models\Animal;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SanteExport;

class SanteController extends Controller
{
    public function index()
    {
        $santes = Sante::orderBy('id','desc')->get();
        return view('santes.index', compact('santes'));
    }

    public function create()
    {
        $animals = Animal::all(); // Récupère tous les animaux
        return view('santes.create', compact('animals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'diagnostic' => 'required|string',
            'traitement' => 'nullable|string',
            'date' => 'required|date',
            'animal_id' => 'required|exists:animals,id',
        ]);

        Sante::create($request->only(['nom','diagnostic','traitement','date','animal_id']));

        return redirect()->route('santes.index')->with('success','Suivi santé ajouté avec succès.');
    }

    public function edit(Sante $sante)
    {
        $animals = Animal::all();
        return view('santes.edit', compact('sante', 'animals'));
    }

    public function update(Request $request, Sante $sante)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'diagnostic' => 'required|string',
            'traitement' => 'nullable|string',
            'date' => 'required|date',
            'animal_id' => 'required|exists:animals,id',
        ]);

        $sante->update($request->only(['nom','diagnostic','traitement','date','animal_id']));

        return redirect()->route('santes.index')->with('success','Suivi santé modifié avec succès.');
    }

    public function destroy(Sante $sante)
    {
        $sante->delete();
        return redirect()->route('santes.index')->with('success','Suivi santé supprimé.');
    }

    // ====================== EXPORT PDF ======================
    public function exportPdf()
    {
        $santes = Sante::orderBy('id','desc')->get();
        $pdf = PDF::loadView('santes.pdf', compact('santes'));
        return $pdf->download('santes.pdf');
    }

    // ====================== EXPORT EXCEL ======================
    public function exportExcel()
    {
        return Excel::download(new SanteExport, 'santes.xlsx');
    }
}
