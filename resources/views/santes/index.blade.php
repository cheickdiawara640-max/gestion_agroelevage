@extends('layouts.app')

@section('title', 'Liste des Suivis Santé')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>💊 Suivis Santé</h2>
        <a href="{{ route('santes.create') }}" class="btn btn-success">➕ Ajouter un suivi</a>
    </div>

    <div class="mb-3">
        <a href="{{ route('santes.export.pdf') }}" class="btn btn-secondary">Exporter PDF</a>
        <a href="{{ route('santes.export.excel') }}" class="btn btn-info">Exporter Excel</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Animal</th>
                <th>Diagnostic</th>
                <th>Traitement</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($santes as $sante)
            <tr>
                <td>{{ $sante->id }}</td>
                <td>{{ $sante->animal->nom ?? 'Non défini' }}</td>
                <td>{{ $sante->diagnostic }}</td>
                <td>{{ $sante->traitement ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($sante->date)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('santes.edit', $sante->id) }}" class="btn btn-warning btn-sm">✏️</a>
                    <form action="{{ route('santes.destroy', $sante->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce suivi ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Aucun suivi santé enregistré.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
