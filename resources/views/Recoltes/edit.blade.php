@extends('layouts.app')

@section('title', 'Modifier une Récolte')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">✏️ Modifier une Récolte</h1>

    <!-- Messages d'erreur -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recoltes.update', $recolte->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Parcelle -->
        <div class="mb-3">
            <label for="parcelle_id" class="form-label">Parcelle</label>
            <select name="parcelle_id" id="parcelle_id" class="form-select" required>
                <option value="">-- Sélectionner une parcelle --</option>
                @foreach($parcelles as $parcelle)
                    <option value="{{ $parcelle->id }}" {{ $recolte->parcelle_id == $parcelle->id ? 'selected' : '' }}>
                        {{ $parcelle->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Culture -->
        <div class="mb-3">
            <label for="culture" class="form-label">Culture</label>
            <input type="text" name="culture" id="culture" class="form-control" value="{{ old('culture', $recolte->culture) }}" required>
        </div>

        <!-- Quantité -->
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="{{ old('quantite', $recolte->quantite) }}" required>
        </div>

        <!-- Date de récolte -->
        <div class="mb-3">
            <label for="date_recolte" class="form-label">Date de récolte</label>
            <input type="date" name="date_recolte" id="date_recolte" class="form-control" value="{{ old('date_recolte', $recolte->date_recolte) }}" required>
        </div>

        <!-- Remarques -->
        <div class="mb-3">
            <label for="remarques" class="form-label">Remarques</label>
            <textarea name="remarques" id="remarques" class="form-control">{{ old('remarques', $recolte->remarques) }}</textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('recoltes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Retour
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
