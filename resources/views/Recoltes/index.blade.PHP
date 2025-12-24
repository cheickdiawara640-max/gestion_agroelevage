@extends('layouts.app')

@section('title', 'Liste des Récoltes')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">📋 Liste des Récoltes</h1>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('recoltes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une récolte
        </a>

        <div>
        
             <a href="{{route('recoltes.export.pdf')  }}" class="btn btn-success border-end">
                📄 Exporter PDF
        <a href="{{ route('recoltes.export.excel') }}" class="btn btn-success">📊 Exporter Excel</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Parcelle</th>
                    <th>Culture</th>
                    <th>Quantité</th>
                    <th>Date de récolte</th>
                    <th>Remarques</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recoltes as $recolte)
                    <tr>
                        <td>{{ $recolte->id }}</td>
                        <td>{{ $recolte->parcelle->nom ?? '-' }}</td>
                        <td>{{ $recolte->culture }}</td>
                        <td>{{ $recolte->quantite }}</td>
                        <td>{{ \Carbon\Carbon::parse($recolte->date_recolte)->format('d/m/Y') }}</td>
                        <td>{{ $recolte->remarques ?? '-' }}</td>
                        <td>
                            <a href="{{ route('recoltes.edit', $recolte->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('recoltes.destroy', $recolte->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette récolte ?')">
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
                        <td colspan="7" class="text-center">Aucune récolte trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
