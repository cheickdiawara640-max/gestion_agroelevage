@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Détails de l'animal : {{ $animal->nom }}</h2>
        <a href="{{ route('animaux.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h5 class="mb-0">Fiche d'identité</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <span style="font-size: 4rem;">{{ $animal->sexe == 'Mâle' ? '🐂' : '🐄' }}</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">ID Système :</span> <strong>#{{ $animal->id }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Race :</span> <strong>{{ $animal->race ?? 'Non précisée' }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Sexe :</span> 
                            <span class="badge {{ $animal->sexe == 'Mâle' ? 'bg-info' : 'bg-danger' }}">
                                {{ $animal->sexe }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Naissance :</span> 
                            <strong>{{ $animal->date_naissance ? \Carbon\Carbon::parse($animal->date_naissance)->format('d/m/Y') : 'Inconnue' }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Santé :</span> 
                            <span class="fw-bold {{ $animal->etat_sante == 'malade' ? 'text-danger' : 'text-success' }}">
                                {{ strtoupper($animal->etat_sante ?? 'Bonne') }}
                            </span>
                        </li>
                    </ul>
                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('animaux.edit', $animal->id) }}" class="btn btn-warning">Modifier la fiche</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-diagram-3 text-primary"></i> Arbre Généalogique (Lignée)</h5>

                <div class="genealogy-tree text-center">
                    <div class="row mb-3">
                        <div class="col-3"><small class="text-muted">G-Père Pat.</small></div>
                        <div class="col-3"><small class="text-muted">G-Mère Pat.</small></div>
                        <div class="col-3"><small class="text-muted">G-Père Mat.</small></div>
                        <div class="col-3"><small class="text-muted">G-Mère Mat.</small></div>
                    </div>

                    <div class="row align-items-center mb-4">
                        <div class="col-6">
                            <div class="p-3 border rounded-3 {{ $animal->pere ? 'bg-aliceblue border-primary' : 'bg-light' }}">
                                <small class="d-block text-uppercase fw-bold text-primary">Père</small>
                                @if($animal->pere)
                                    <a href="{{ route('animaux.show', $animal->pere->id) }}" class="text-decoration-none fw-bold text-dark">
                                        ♂️ {{ $animal->pere->nom }}
                                    </a>
                                    <div class="small text-muted">{{ $animal->pere->race }}</div>
                                @else
                                    <span class="text-muted small italic">Inconnu</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded-3 {{ $animal->mere ? 'bg-lavenderblush border-danger' : 'bg-light' }}">
                                <small class="d-block text-uppercase fw-bold text-danger">Mère</small>
                                @if($animal->mere)
                                    <a href="{{ route('animaux.show', $animal->mere->id) }}" class="text-decoration-none fw-bold text-dark">
                                        ♀️ {{ $animal->mere->nom }}
                                    </a>
                                    <div class="small text-muted">{{ $animal->mere->race }}</div>
                                @else
                                    <span class="text-muted small italic">Inconnue</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="p-4 border-primary border-3 border rounded-4 bg-white shadow-sm">
                                <h4 class="mb-0 fw-bold">{{ $animal->nom }}</h4>
                                <span class="text-muted">Sujet actuel</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                <h5 class="fw-bold mb-3"><i class="bi bi-house-heart text-success"></i> Descendance (Ses petits)</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Sexe</th>
                                <th>Date de naissance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // On récupère les enfants (où cet animal est père OU mère)
                                $enfants = \App\Models\Animal::where('pere_id', $animal->id)->orWhere('mere_id', $animal->id)->get();
                            @endphp
                            @forelse($enfants as $enfant)
                                <tr>
                                    <td>{{ $enfant->nom }}</td>
                                    <td>{{ $enfant->sexe }}</td>
                                    <td>{{ $enfant->date_naissance ?? '---' }}</td>
                                    <td><a href="{{ route('animaux.show', $enfant->id) }}" class="btn btn-link btn-sm p-0">Voir fiche</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted small">Aucun descendant enregistré.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-aliceblue { background-color: #f0f8ff; }
    .bg-lavenderblush { background-color: #fff0f5; }
    .border-primary { border-color: #0d6efd !important; }
    .border-danger { border-color: #dc3545 !important; }
</style>
@endsection