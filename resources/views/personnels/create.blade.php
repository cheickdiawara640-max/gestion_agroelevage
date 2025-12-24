@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un Personnel</h2>

    <form action="{{ route('personnels.store') }}" method="POST">
        @csrf

        <!-- Nom -->
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <!-- Poste -->
        <div class="mb-3">
            <label class="form-label">Poste</label>
            <input type="text" name="poste" class="form-control">
        </div>

        <!-- Salaire -->
        <div class="mb-3">
            <label class="form-label">Salaire</label>
            <input type="number" step="0.01" name="salaire" class="form-control">
        </div>

        <!-- Téléphone -->
        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control">
        </div>

        <!-- Date de recrutement -->
        <div class="mb-3">
            <label class="form-label">Date de recrutement</label>
            <input type="date" name="date_recrutement" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
