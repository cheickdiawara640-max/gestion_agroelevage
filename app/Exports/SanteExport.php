<?php

namespace App\Exports;

use App\Models\Sante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SanteExport implements FromCollection, WithHeadings
{
    /**
     * Retourne toutes les entrées de santé pour l'export.
     */
    public function collection()
    {
        return Sante::select('id', 'animal_id', 'diagnostic', 'traitement', 'date')->get();
    }

    /**
     * Définit les en-têtes de colonnes pour Excel.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Animal ID',
            'Diagnostic',
            'Traitement',
            'Date',
        ];
    }
}
