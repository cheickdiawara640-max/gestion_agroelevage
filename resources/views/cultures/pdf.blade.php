<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Cultures</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Liste des Cultures</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Parcelle</th>
                <th>Période Semis</th>
                <th>Période Récolte</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cultures as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nom }}</td>
                <td>{{ $c->type }}</td>
                <td>{{ $c->parcelle->nom ?? '-' }}</td>
                <td>{{ $c->periode_semis }}</td>
                <td>{{ $c->periode_recolte }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total Cultures : {{ $cultures->count() }}</p>
</body>
</html>
