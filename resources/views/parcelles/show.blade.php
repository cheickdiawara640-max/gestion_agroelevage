@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-4">
        <h2 class="fw-bold">🌍 Parcelle : {{ $parcelle->nom }}</h2>
        <a href="{{ route('parcelles.index') }}" class="btn btn-outline-secondary rounded-pill">Retour</a>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <div class="display-5 mb-2">🗺️</div>
                    <h5 class="fw-bold">{{ $parcelle->nom }}</h5>
                    <hr>
                    <div class="text-start">
                        <p><strong>Surface :</strong> {{ $parcelle->surface }} m²</p>
                        <p><strong>Localisation :</strong> {{ $parcelle->emplacement ?? 'Non définie' }}</p>
                        <p><strong>État :</strong> 
                            <span class="badge {{ $parcelle->statut == 'occupe' ? 'bg-warning' : 'bg-success' }}">
                                {{ $parcelle->statut ?? 'Libre' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-flower1 text-success"></i> Cultures sur cette parcelle</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Date Plantation</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cultures as $c)
                        <tr>
                            <td>{{ $c->type_culture }}</td>
                            <td>{{ $c->date_debut }}</td>
                            <td><span class="badge bg-info text-white">{{ $c->statut }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted">Aucune culture enregistrée ici.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection