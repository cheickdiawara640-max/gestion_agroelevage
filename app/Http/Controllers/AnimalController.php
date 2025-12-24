<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnimalExport;

class AnimalController extends Controller
{
    public function index()
    {
        $animaux = Animal::orderBy('id','desc')->get();
        return view('animaux.index', compact('animaux'));
    }

 public function create()
{
    // On sépare pour éviter de choisir une femelle comme père !
    $peres = Animal::where('sexe', 'Mâle')->orderBy('nom')->get();
    $meres = Animal::where('sexe', 'Femelle')->orderBy('nom')->get();

    return view('animaux.create', compact('peres', 'meres'));
}

public function edit(Animal $animaux)
{
    // Pour la modification, on exclut l'animal lui-même de la liste
    $peres = Animal::where('sexe', 'Mâle')->where('id', '!=', $animaux->id)->get();
    $meres = Animal::where('sexe', 'Femelle')->where('id', '!=', $animaux->id)->get();

    return view('animaux.edit', [
        'animal' => $animaux, 
        'peres' => $peres, 
        'meres' => $meres
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'race' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'sexe' => 'nullable|string|max:20',
            'etat_sante' => 'nullable|string|max:255',
            'pere_id' => 'nullable|exists:animals,id', // NOUVEAU
            'mere_id' => 'nullable|exists:animals,id', // NOUVEAU
        ]);

        // On ajoute les IDs des parents dans la création
        Animal::create($request->only(['nom','race','date_naissance','sexe','etat_sante', 'pere_id', 'mere_id']));

        return redirect()->route('animaux.index')->with('success','Animal ajouté avec succès avec sa lignée.');
    }

    

    public function update(Request $request, Animal $animaux)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'race' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'sexe' => 'nullable|string|max:20',
            'etat_sante' => 'nullable|string|max:255',
            'pere_id' => 'nullable|exists:animals,id', // NOUVEAU
            'mere_id' => 'nullable|exists:animals,id', // NOUVEAU
        ]);

        // Mise à jour incluant les parents
        $animaux->update($request->only(['nom','race','date_naissance','sexe','etat_sante', 'pere_id', 'mere_id']));

        return redirect()->route('animaux.index')->with('success','Animal mis à jour avec succès.');
    }

    public function destroy(Animal $animaux)
    {
        $animaux->delete();
        return redirect()->route('animaux.index')->with('success','Animal supprimé.');
    }

    public function show(Animal $animaux)
    {
        // On charge les relations père et mère pour les afficher
        $animaux->load(['pere', 'mere']);
        return view('animaux.show', ['animal' => $animaux]);
    }

    // ---------------- PDF / Excel (Inchangés) ----------------

    public function exportPdf()
    {
        $animaux = Animal::orderBy('id','desc')->get();
        $fields = ['id','nom','race','date_naissance','sexe','etat_sante'];

        $pdf = PDF::loadView('animaux.pdf', compact('animaux','fields'));
        return $pdf->download('animaux.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new AnimalExport, 'animaux.xlsx');
    }
}