@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">🧪 Gestion des Traitements Phytosanitaires</h2>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="d-flex justify-content-between mb-3">
        <div class="btn-group shadow-sm" role="group">
            <a href="{{ route('traitements.export.excel') }}" class="btn btn-success border-end">
                📄 Exporter Excel
            </a>
            <a href="{{ route('traitements.export.pdf') }}" class="btn btn-danger">
                🖨️ Exporter PDF
            </a>
        </div>
        
        <a href="{{ route('traitements.create') }}" class="btn btn-primary shadow-sm">
            ➕ Ajouter un Traitement
        </a>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Type</th>
                        <th>Dose</th>
                        <th>Appliqué le</th>
                        <th>Culture / Parcelle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($traitements as $traitement)
                        <tr>
                            <td>{{ $traitement->id }}</td>
                            <td>{{ $traitement->nom_produit }}</td>
                            <td>{{ $traitement->type_produit }}</td>
                            <td>
                                {{ $traitement->dose }} {{ $traitement->unite_dose }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($traitement->date_application)->format('d/m/Y') }}</td>
                            <td>
                                @if($traitement->culture)
                                    **Culture:** {{ $traitement->culture->nom }}
                                @elseif($traitement->parcelle)
                                    **Parcelle:** {{ $traitement->parcelle->nom }}
                                @else
                                    *Non lié*
                                @endif
                            </td>
                            <td>
                                
                                <a href="{{ route('traitements.edit', $traitement->id) }}" class="btn btn-warning btn-sm" title="Modifier">✍️</a>
                                
                                <form action="{{ route('traitements.destroy', $traitement->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Confirmer la suppression de ce traitement ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="lead text-muted">Aucun traitement phytosanitaire enregistré pour l'instant.</p>
                                <a href="{{ route('traitements.create') }}" class="btn btn-success mt-2">Enregistrer le premier traitement</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $traitements->links() }}
    </div>
</div>
@endsection