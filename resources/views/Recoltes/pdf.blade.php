<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Récoltes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #ddd; }
    </style>
</head>
<body>
    <h2>Liste des Récoltes</h2>
    <table>
        <thead>
            <tr>
                @foreach($fields as $field)
                    <th>{{ ucfirst(str_replace('_', ' ', $field)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($recoltes as $recolte)
                <tr>
                    <td>{{ $recolte->id }}</td>
                    <td>{{ $recolte->culture->nom ?? 'Non défini' }}</td>
                    <td>{{ $recolte->quantite }} kg</td>
                    <td>{{ $recolte->date_recolte }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
