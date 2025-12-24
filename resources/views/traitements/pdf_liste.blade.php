<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Traitements - Export PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 8px; }
        h1 { text-align: center; color: #4CAF50; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 4px; text-align: left; }
        th { background-color: #f2f2f2; font-size: 9px; }
        .footer { text-align: right; margin-top: 20px; font-size: 7px; }
    </style>
</head>
<body>

    <h1>🧪 Liste des Traitements Phytosanitaires</h1>
    <p>Rapport généré le : {{ \Carbon\Carbon::now()->format('d/m/Y à H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Type</th>
                <th>Dose</th>
                <th>Date App.</th>
                <th>Culture</th>
                <th>Parcelle</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($traitements as $traitement)
                <tr>
                    <td>{{ $traitement->id }}</td>
                    <td>{{ $traitement->nom_produit }}</td>
                    <td>{{ $traitement->type_produit }}</td>
                    <td>{{ $traitement->dose }} {{ $traitement->unite_dose }}</td>
                    <td>{{ \Carbon\Carbon::parse($traitement->date_application)->format('d/m/Y') }}</td>
                    <td>{{ $traitement->culture ? $traitement->culture->nom : 'N/A' }}</td>
                    <td>{{ $traitement->parcelle ? $traitement->parcelle->nom : 'N/A' }}</td>
                    <td>{{ Str::limit($traitement->notes, 50) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Page 1/1
    </div>

</body>
</html>