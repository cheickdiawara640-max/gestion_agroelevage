<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Personnel PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Liste du Personnel</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Poste</th>
                <th>Salaire</th>
                <th>Téléphone</th>
                <th>Date Recrutement</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personnels as $personnel)
                <tr>
                    <td>{{ $personnel->id }}</td>
                    <td>{{ $personnel->nom }}</td>
                    <td>{{ $personnel->poste ?: '-' }}</td>
                    <td>
                        @if($personnel->salaire)
                            {{ number_format($personnel->salaire, 0, ',', ' ') }} FCFA
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $personnel->telephone ?: '-' }}</td>
                    <td>
                        {{ $personnel->date_recrutement ? \Carbon\Carbon::parse($personnel->date_recrutement)->format('d/m/Y') : '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
