<?php

namespace App\Exports;

use App\Models\Recolte;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecolteExport implements FromCollection, WithHeadings
{
    /**
     * Récupère toutes les récoltes avec relation culture
     */
    public function collection()
    {
        return Recolte::with('culture')->get()->map(function($recolte) {
            return [
                'ID' => $recolte->id,
                'Culture' => $recolte->culture->nom ?? 'Non défini',
                'Quantité (kg)' => $recolte->quantite,
                'Date' => $recolte->date_recolte,
            ];
        });
    }

    /**
     * En-têtes du fichier Excel
     */
    public function headings(): array
    {
        return ['ID', 'Culture', 'Quantité (kg)', 'Date'];
    }
}
