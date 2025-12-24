<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivis Santé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 8px 6px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        caption {
            caption-side: bottom;
            text-align: center;
            font-size: 10px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h2>💊 Liste des suivis santé</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Animal</th>
                <th>Diagnostic</th>
                <th>Traitement</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($santes as $sante)
            <tr>
                <td>{{ $sante->id }}</td>
                <td>{{ $sante->animal->nom ?? 'Non défini' }}</td>
                <td>{{ $sante->diagnostic }}</td>
                <td>{{ $sante->traitement ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($sante->date)->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Aucun suivi santé enregistré.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <caption>Généré le {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</caption>

</body>
</html>
