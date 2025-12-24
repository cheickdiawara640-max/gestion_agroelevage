@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Liste des besoins</h1>

    <a href="{{ route('besoins.create') }}" class="btn btn-primary mb-3">Ajouter un besoin</a>

    <div class="mb-3">
        <a href="{{ route('besoins.export.pdf') }}" class="btn btn-secondary">Exporter PDF</a>
        <a href="{{ route('besoins.export.excel') }}" class="btn btn-success">Exporter Excel</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($besoins as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->titre }}</td>
                <td>{{ number_format($b->montant, 0, ',', ' ') }} FCFA</td>
                <td>{{ $b->date_demande }}</td>
                <td>{{ $b->description }}</td>
                <td>
                    <a href="{{ route('besoins.edit', $b->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('besoins.destroy', $b->id) }}" method="POST" style="display:inline;">
                        @csrf 
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce besoin ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
