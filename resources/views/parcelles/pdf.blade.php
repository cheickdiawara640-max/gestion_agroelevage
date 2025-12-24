<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Parcelles</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Liste des Parcelles</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Superficie</th>
                <th>Localisation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parcelles as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nom }}</td>
                <td>{{ $p->superficie }} ha</td>
                <td>{{ $p->localisation ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total Parcelles : {{ $parcelles->count() }}</p>
</body>
</html>
