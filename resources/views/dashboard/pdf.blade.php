<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard PDF</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 5px; }
        .grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; }
        .card { padding: 10px; border-radius: 8px; text-align: center; color: #fff; }
        .card span { display: block; margin-top: 5px; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Dashboard - Vue complète</h1>
    <div class="grid">
        @foreach($cards as $card)
        <div class="card" style="background-color: {{ $card['color'] }}">
            <span style="font-size: 2em;">{{ $card['icon'] }}</span>
            <span style="font-weight: bold;">{{ $card['title'] }}</span>
            <span>{{ $card['count'] }}</span>
            @if($card['badge'])
            <span style="background:red; color:#fff; border-radius:5px; padding:2px 5px; font-size:0.8em;">{{ $card['badge'] }}</span>
            @endif
        </div>
        @endforeach
    </div>
</body>
</html>
