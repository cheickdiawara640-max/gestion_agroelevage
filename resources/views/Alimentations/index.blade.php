@extends('layouts.app')

@section('title', 'Liste des Alimentations')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">📋 Liste des Alimentations</h1>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('alimentations.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une alimentation
        </a>

        <div>
            <a href="{{ route('alimentations.export.pdf') }}" class="btn btn-secondary">
                <i class="bi bi-file-earmark-pdf"></i> Exporter PDF
            </a>
            <a href="{{ route('alimentations.export.excel') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Exporter Excel
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Date</th>
                    <th>Animal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alimentations as $alim)
                    <tr>
                        <td>{{ $alim->id }}</td>
                        <td>{{ $alim->type }}</td>
                        <td>{{ $alim->description ?? '-' }}</td>
                        <td>{{ $alim->quantite }}</td>
                        <td>{{ \Carbon\Carbon::parse($alim->date_alimentation)->format('d/m/Y') }}</td>
                        <td>{{ $alim->animal->nom ?? '-' }}</td>
                        <td>
                            <a href="{{ route('alimentations.edit', $alim->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('alimentations.destroy', $alim->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette alimentation ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucune alimentation trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
