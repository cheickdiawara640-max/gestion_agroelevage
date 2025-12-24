<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Journal des Ventes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 8px; }
        h1 { text-align: center; color: #48BB78; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 4px; text-align: left; }
        th { background-color: #f2f2f2; font-size: 9px; }
        .total-row td { background-color: #e6ffed; font-weight: bold; }
    </style>
</head>
<body>

    <h1>💲 Journal des Ventes (Export PDF)</h1>
    <p>Période : Du {{ $ventes->min('date_vente') ? \Carbon\Carbon::parse($ventes->min('date_vente'))->format('d/m/Y') : 'Début' }} au {{ $ventes->max('date_vente') ? \Carbon\Carbon::parse($ventes->max('date_vente'))->format('d/m/Y') : 'Aujourd\'hui' }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Mode Vente</th>
                <th>Paiement</th>
                <th>Prix Unitaire</th>
                <th>Montant Total</th>
                <th>Client</th>
                <th>Récolte ID</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_general = 0;
            @endphp
            @foreach ($ventes as $vente)
                @php
                    $total_general += $vente->montant_total;
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</td>
                    <td>{{ $vente->produit_vendu }}</td>
                    <td>{{ $vente->quantite_vendue }} {{ $vente->unite_quantite }}</td>
                    <td>{{ $vente->mode_vente }}</td>
                    <td>{{ $vente->mode_paiement }}</td>
                    <td>{{ number_format($vente->prix_unitaire, 0, ',', ' ') }} F</td>
                    <td style="color:#2d3748; font-weight: bold;">{{ number_format($vente->montant_total, 0, ',', ' ') }} F</td>
                    <td>{{ $vente->client_nom ?? 'N/A' }}</td>
                    <td>#{{ $vente->recolte_id }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="6" style="text-align: right;">TOTAL GÉNÉRAL DES VENTES :</td>
                <td>{{ number_format($total_general, 0, ',', ' ') }} F</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 50px; text-align: right; font-size: 7px;">Généré par l'application le {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

</body>
</html>