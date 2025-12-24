<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Budgets PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>📊 Liste des Budgets</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($budgets as $budget)
                <tr>
                    <td>{{ $budget->id }}</td>
                    <td>{{ $budget->nom }}</td>
                    <td>{{ number_format($budget->montant, 0, ',', ' ') }} FCFA</td>
                    <td>{{ \Carbon\Carbon::parse($budget->date)->format('d/m/Y') }}</td>
                    <td>{{ $budget->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
