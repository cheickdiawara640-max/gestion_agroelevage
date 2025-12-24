<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonnelExport;

class PersonnelController extends Controller
{
   
public function index()
{
    $personnels = Personnel::all();
    return view('personnels.index', compact('personnels'));
}

public function create()
{
    return view('personnels.create');
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:191',
        'poste' => 'nullable|string|max:191',
        'salaire' => 'nullable|numeric',
        'telephone' => 'nullable|string|max:191',
        'date_recrutement' => 'nullable|date',
    ]);

    Personnel::create($request->all());

    return redirect()->route('personnels.index')->with('success','Personnel ajouté.');
}

    public function edit(Personnel $personnel)
    {
        return view('personnels.edit', compact('personnel'));
    }

    public function update(Request $request, Personnel $personnel)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'contact' => 'nullable|string|max:50',
             'salaire' => 'nullable|string|max:50',
            'date Embauche' => 'nullable|date',
        ]);

        $personnel->update($request->all());
        return redirect()->route('personnels.index')->with('success','Personnel modifié.');
    }

    public function destroy(Personnel $personnel)
    {
        $personnel->delete();
        return redirect()->route('personnels.index')->with('success','Personnel supprimé.');
    }

    // ====================== EXPORT PDF ======================
    public function exportPdf()
    {
        $personnels = Personnel::orderBy('id','desc')->get();
        $pdf = PDF::loadView('personnels.pdf', compact('personnels'));
        return $pdf->download('personnels.pdf');
    }

    // ====================== EXPORT EXCEL ======================
    public function exportExcel()
    {
        return Excel::download(new PersonnelExport, 'personnels.xlsx');
    }
}
