<!DOCTYPE html>
<html>
<head>
    <title>Liste des Alimentations</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Liste des Alimentations</h2>
    <table>
        <thead>
            <tr>
                @foreach($fields as $field)
                    <th>{{ ucfirst($field) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($alimentations as $alim)
                <tr>
                    @foreach($fields as $field)
                        <td>{{ $alim->$field }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
