<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alimentation;
use App\Models\Animal;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlimentationExport;

class AlimentationController extends Controller
{
    // Afficher la liste
    public function index()
    {
        $alimentations = Alimentation::all();
        return view('alimentations.index', compact('alimentations'));
    }

    // Formulaire de création
    public function create()
    {
        $animals = Animal::all(); // ⚠️ On transmet les animaux à la vue
        return view('alimentations.create', compact('animals'));
    }

    // Stocker une nouvelle alimentation
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite' => 'required|numeric',
            'date_alimentation' => 'required|date',
            'animal_id' => 'required|exists:animals,id',
        ]);

        Alimentation::create($request->all());

        return redirect()->route('alimentations.index')->with('success','Alimentation ajoutée.');
    }

    // Modifier
    public function edit(Alimentation $alimentation)
    {
        $animals = Animal::all();
        return view('alimentations.edit', compact('alimentation','animals'));
    }

    // Mettre à jour
    public function update(Request $request, Alimentation $alimentation)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite' => 'required|numeric',
            'date_alimentation' => 'required|date',
            'animal_id' => 'required|exists:animals,id',
        ]);

        $alimentation->update($request->all());

        return redirect()->route('alimentations.index')->with('success','Alimentation mise à jour.');
    }

    // Supprimer
    public function destroy(Alimentation $alimentation)
    {
        $alimentation->delete();
        return redirect()->route('alimentations.index')->with('success','Alimentation supprimée.');
    }

    // Export PDF
    public function exportPdf()
    {
        $alimentations = Alimentation::orderBy('id','desc')->get();
        $fields = ['id','type','description','quantite','date_alimentation','animal_id'];
        $pdf = PDF::loadView('alimentations.pdf', compact('alimentations','fields'));
        return $pdf->download('alimentations.pdf');
    }

    // Export Excel
    public function exportExcel()
    {
        return Excel::download(new AlimentationExport, 'alimentations.xlsx');
    }
}
