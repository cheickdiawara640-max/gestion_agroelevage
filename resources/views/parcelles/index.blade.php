@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Parcelles</h1>
    <a href="{{ route('parcelles.create') }}" class="btn btn-primary mb-3">Ajouter une parcelle</a>
    <a href="{{ route('parcelles.export.pdf') }}" class="btn btn-secondary">Exporter PDF</a>
    <a href="{{ route('parcelles.export.excel') }}" class="btn btn-primary">Exporter Excel</a>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <thead style="background-color: #FF9800; color: white;">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Superficie (ha)</th>
                <th>Localisation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parcelles as $parcelle)
                <tr>
                    <td>{{ $parcelle->id }}</td>
                    <td>{{ $parcelle->nom }}</td>
                    <td>{{ $parcelle->superficie }}</td>
                    <td>{{ $parcelle->localisation }}</td>
                    <td>
                        <a href="{{ route('parcelles.edit', $parcelle->id) }}" style="color: blue; margin-right: 10px;">Modifier</a>
                        <form action="{{ route('parcelles.destroy', $parcelle->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red; background:none; border:none; cursor:pointer;" onclick="return confirm('Supprimer cette parcelle ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
