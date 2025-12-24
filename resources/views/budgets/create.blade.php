@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>➕ Ajouter un budget</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('budgets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Montant</label>
            <input type="number" name="montant" step="0.01" class="form-control" value="{{ old('montant') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="recette" {{ old('type') == 'recette' ? 'selected' : '' }}>Recette</option>
                <option value="depense" {{ old('type') == 'depense' ? 'selected' : '' }}>Dépense</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
        </div>

        <button type="submit" class="btn btn-success">💾 Enregistrer</button>
        <a href="{{ route('budgets.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
