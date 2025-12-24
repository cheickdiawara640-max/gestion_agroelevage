@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Liste des Cultures</h1>

    <!-- Boutons Ajouter / Export -->
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('cultures.create') }}" class="btn btn-success">Ajouter</a>
        <a href="{{ route('cultures.export.pdf') }}" class="btn btn-secondary">Exporter PDF</a>
        <a href="{{ route('cultures.export.excel') }}" class="btn btn-primary">Exporter Excel</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Parcelle</th>
                <th>Période Semis</th>
                <th>Période Récolte</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cultures as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->nom }}</td>
                <td>{{ $c->type }}</td>
                <td>{{ $c->parcelle->nom ?? '-' }}</td>
                <td>{{ $c->periode_semis }}</td>
                <td>{{ $c->periode_recolte }}</td>
                <td>
                    <a href="{{ route('cultures.edit', $c->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('cultures.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette culture ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Aucune culture trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
