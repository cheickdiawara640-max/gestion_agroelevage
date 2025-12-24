<?php

// app/Exports/VentesExport.php

namespace App\Exports;

use App\Models\Vente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VentesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Récupère toutes les ventes avec la récolte liée
        return Vente::with('recolte')->get();
    }

    public function headings(): array
    {
        return [
            'ID Vente',
            'Date Vente',
            'Produit Vendu',
            'Quantité Vendue',
            'Unité',
            'Prix Unitaire (F)',
            'Montant Total (F)',
            'Mode Vente',
            'Mode Paiement',
            'Client',
            'Récolte ID',
        ];
    }

    public function map($vente): array
    {
        return [
            $vente->id,
            $vente->date_vente,
            $vente->produit_vendu,
            $vente->quantite_vendue,
            $vente->unite_quantite,
            $vente->prix_unitaire,
            $vente->montant_total,
            $vente->mode_vente,
            $vente->mode_paiement,
            $vente->client_nom,
            $vente->recolte_id,
        ];
    }
}
