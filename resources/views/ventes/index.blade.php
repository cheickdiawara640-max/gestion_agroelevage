@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">💲 Registre des Transactions de Vente</h2>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
    <div class="btn-group shadow-sm" role="group">
        <a href="{{ route('ventes.export.excel') }}" class="btn btn-success border-end">
            📄 Exporter Excel
        </a>
        <a href="{{ route('ventes.export.pdf') }}" class="btn btn-danger">
            🖨️ Exporter PDF
        </a>
    </div>
    
    <a href="{{ route('ventes.create') }}" class="btn btn-primary shadow-sm">
        ➕ Enregistrer une Nouvelle Vente
    </a>
</div>

    <div class="card shadow-lg border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>P. Unitaire</th>
                        <th>Montant Total</th>
                        <th>Mode de Vente</th>
                        <th>Récolte #</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ventes as $vente)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</td>
                            <td>{{ $vente->produit_vendu }}</td>
                            <td>{{ $vente->quantite_vendue }} {{ $vente->unite_quantite }}</td>
                            <td>{{ number_format($vente->prix_unitaire, 0, ',', ' ') }} F</td>
                            <td>
                                <span class="fw-bold text-success">{{ number_format($vente->montant_total, 0, ',', ' ') }} F</span>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $vente->mode_vente }}</span>
                            </td>
                            <td>
                                <a href="{{ route('recoltes.show', $vente->recolte_id) }}" title="Voir la récolte associée">
                                    #{{ $vente->recolte_id }}
                                </a>
                            </td>
                            <td>
                                
                                <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-warning btn-sm" title="Modifier">✍️</a>
                                
                                <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Confirmer la suppression de cette vente ?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <p class="lead text-muted">Aucune transaction de vente enregistrée pour l'instant.</p>
                                <a href="{{ route('ventes.create') }}" class="btn btn-success mt-2">Enregistrer la première vente</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $ventes->links() }}
    </div>
</div>
@endsection