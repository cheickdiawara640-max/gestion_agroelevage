<?php

// app/Exports/TraitementsExport.php

namespace App\Exports;

use App\Models\Traitement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TraitementsExport implements FromCollection, WithHeadings, WithMapping
{
    // 1. Définir la collection de données
    public function collection()
    {
        // On récupère les traitements avec les relations Culture et Parcelle
        return Traitement::with(['culture', 'parcelle'])->get();
    }

    // 2. Définir les en-têtes de colonnes
    public function headings(): array
    {
        return [
            'ID',
            'Nom Produit',
            'Type',
            'Dose',
            'Unité',
            'Date Application',
            'Culture',
            'Parcelle',
            'Notes',
            'Créé le',
        ];
    }

    // 3. Mapper les données à exporter
    public function map($traitement): array
    {
        return [
            $traitement->id,
            $traitement->nom_produit,
            $traitement->type_produit,
            "{$traitement->dose}", // Convertir en chaîne pour éviter les formats complexes
            $traitement->unite_dose,
            $traitement->date_application,
            $traitement->culture ? $traitement->culture->nom : 'N/A',
            $traitement->parcelle ? $traitement->parcelle->nom : 'N/A',
            $traitement->notes,
            $traitement->created_at,
        ];
    }
}
