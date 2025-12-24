@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">➕ Enregistrer un Nouveau Traitement</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('traitements.store') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nom_produit" class="form-label">Nom du Produit:</label>
                        <input type="text" class="form-control" id="nom_produit" name="nom_produit" value="{{ old('nom_produit') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="type_produit" class="form-label">Type (Pesticide, Fongicide, etc.):</label>
                        <input type="text" class="form-control" id="type_produit" name="type_produit" value="{{ old('type_produit') }}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="dose" class="form-label">Dose appliquée:</label>
                        <input type="number" step="0.01" class="form-control" id="dose" name="dose" value="{{ old('dose') }}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="unite_dose" class="form-label">Unité (ex: L/Ha):</label>
                        <input type="text" class="form-control" id="unite_dose" name="unite_dose" value="{{ old('unite_dose') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="date_application" class="form-label">Date d'Application:</label>
                        <input type="date" class="form-control" id="date_application" name="date_application" value="{{ old('date_application') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="culture_id" class="form-label">Culture concernée (Optionnel):</label>
                        <select class="form-select" id="culture_id" name="culture_id">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($cultures as $culture)
                                <option value="{{ $culture->id }}" {{ old('culture_id') == $culture->id ? 'selected' : '' }}>{{ $culture->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="parcelle_id" class="form-label">Parcelle concernée (Optionnel):</label>
                        <select class="form-select" id="parcelle_id" name="parcelle_id">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($parcelles as $parcelle)
                                <option value="{{ $parcelle->id }}" {{ old('parcelle_id') == $parcelle->id ? 'selected' : '' }}>{{ $parcelle->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-12">
                        <label for="notes" class="form-label">Notes / Commentaires:</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success me-2">💾 Enregistrer le Traitement</button>
                    <a href="{{ route('traitements.index') }}" class="btn btn-secondary">↩ Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection