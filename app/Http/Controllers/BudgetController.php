<?php

namespace App\Http\Controllers;
use App\Models\Budget;
use Illuminate\Http\Request;
use PDF; 
class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $budgets = Budget::latest()->get();
    return view('budgets.index', compact('budgets'));
}

public function create()
{
    return view('budgets.create');
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'montant' => 'required|numeric',
        'type' => 'required|in:recette,depense',
        'date' => 'required|date',
    ]);

    Budget::create($request->all());

    return redirect()->route('budgets.index')->with('success', 'Budget ajouté avec succès.');
}

public function edit(Budget $budget)
{
    return view('budgets.edit', compact('budget'));
}

public function update(Request $request, Budget $budget)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'montant' => 'required|numeric',
        'type' => 'required|in:recette,depense',
        'date' => 'required|date',
    ]);

    $budget->update($request->all());

    return redirect()->route('budgets.index')->with('success', 'Budget mis à jour.');
}

public function destroy(Budget $budget)
{
    $budget->delete();
    return redirect()->route('budgets.index')->with('success', 'Budget supprimé.');
}
public function exportPdf()
{
    $budgets = \App\Models\Budget::orderBy('id', 'desc')->get();
    $pdf = PDF::loadView('budgets.pdf', compact('budgets'));
    return $pdf->download('budgets.pdf');
}
}
