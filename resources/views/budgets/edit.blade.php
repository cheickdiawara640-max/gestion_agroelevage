@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>✏️ Modifier un budget</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('budgets.update', $budget->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $budget->nom) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Montant</label>
            <input type="number" name="montant" step="0.01" class="form-control" value="{{ old('montant', $budget->montant) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="recette" {{ old('type', $budget->type) == 'recette' ? 'selected' : '' }}>Recette</option>
                <option value="depense" {{ old('type', $budget->type) == 'depense' ? 'selected' : '' }}>Dépense</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $budget->date) }}" required>
        </div>

        <button type="submit" class="btn btn-success">💾 Mettre à jour</button>
        <a href="{{ route('budgets.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
