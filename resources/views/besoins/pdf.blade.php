<!DOCTYPE html>
<html>
<head>
    <title>Liste des besoins</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Liste des besoins</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($besoins as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->titre }}</td>
                <td>{{ number_format($b->montant, 0, ',', ' ') }} FCFA</td>
                <td>{{ $b->date_demande }}</td>
                <td>{{ $b->description ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
