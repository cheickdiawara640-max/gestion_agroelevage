@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold">Liste des Animaux</h1>

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('animaux.create') }}" class="btn btn-success">➕ Ajouter</a>
        <a href="{{ route('animaux.export.pdf') }}" class="btn btn-secondary">📄 Exporter PDF</a>
        <a href="{{ route('animaux.export.excel') }}" class="btn btn-primary">📊 Exporter Excel</a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Race</th>
                    <th>Sexe</th>
                    <th>Père</th>
                    <th>Mère</th>
                    <th>État Santé</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($animaux as $a)
                <tr>
                    <td class="fw-bold">{{ $a->id }}</td>
                    <td>{{ $a->nom }}</td>
                    <td>{{ $a->race }}</td>
                    <td>
                        <span class="badge {{ $a->sexe == 'Mâle' ? 'bg-info' : 'bg-danger' }}">
                            {{ $a->sexe }}
                        </span>
                    </td>
                    <td class="text-muted">
                        {{ $a->pere ? $a->pere->nom : '---' }}
                    </td>
                    <td class="text-muted">
                        {{ $a->mere ? $a->mere->nom : '---' }}
                    </td>
                    <td>
                        @if($a->etat_sante == 'malade')
                            <span class="text-danger fw-bold">🤒 {{ $a->etat_sante }}</span>
                        @else
                            {{ $a->etat_sante }}
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('animaux.show', $a->id) }}" class="btn btn-info btn-sm text-white">Voir</a>
                            <a href="{{ route('animaux.edit', $a->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('animaux.destroy', $a->id) }}" method="POST" style="display:inline;">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet animal ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">Aucun animal trouvé dans la ferme.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection