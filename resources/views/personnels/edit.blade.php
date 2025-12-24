@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier un Personnel</h2>

    <form action="{{ route('personnels.update', $personnel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $personnel->nom }}" required>
        </div>

        <!-- Poste -->
        <div class="mb-3">
            <label class="form-label">Poste</label>
            <input type="text" name="poste" class="form-control" value="{{ $personnel->poste }}">
        </div>

        <!-- Salaire -->
        <div class="mb-3">
            <label class="form-label">Salaire</label>
            <input type="number" step="0.01" name="salaire" class="form-control" value="{{ $personnel->salaire }}">
        </div>

        <!-- Téléphone -->
        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ $personnel->telephone }}">
        </div>

        <!-- Date recrutement -->
        <div class="mb-3">
            <label class="form-label">Date de recrutement</label>
            <input type="date" name="date_recrutement" class="form-control"
                   value="{{ $personnel->date_recrutement }}">
        </div>

        <button type="submit" class="btn btn-warning">Mettre à jour</button>
    </form>
</div>
@endsection
