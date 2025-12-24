<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Animaux</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Liste des Animaux</h2>
    <table>
        <thead>
            <tr>
                @foreach($fields as $field)
                    <th>{{ ucfirst(str_replace('_',' ',$field)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($animaux as $a)
                <tr>
                    @foreach($fields as $field)
                        <td>{{ $a->$field ?? '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total Animaux : {{ $animaux->count() }}</p>
</body>
</html>
