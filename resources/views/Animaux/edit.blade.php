@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4 rounded-4">
        <h2 class="mb-4 text-center">Modifier l’animal</h2>

        {{-- Affichage des erreurs --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire de modification --}}
        <form action="{{ route('animaux.update', ['animaux' => $animal->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l’animal</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $animal->nom) }}" required>
            </div>

            <div class="mb-3">
                <label for="race" class="form-label">Race</label>
                <input type="text" class="form-control" id="race" name="race" value="{{ old('race', $animal->race) }}">
            </div>

            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $animal->date_naissance) }}">
            </div>

            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe</label>
                <select class="form-select" id="sexe" name="sexe">
                    <option value="">-- Sélectionner --</option>
                    <option value="Mâle" {{ old('sexe', $animal->sexe) == 'Mâle' ? 'selected' : '' }}>Mâle</option>
                    <option value="Femelle" {{ old('sexe', $animal->sexe) == 'Femelle' ? 'selected' : '' }}>Femelle</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="etat_sante" class="form-label">État de santé (optionnel)</label>
                <input type="text" class="form-control" id="etat_sante" name="etat_sante" value="{{ old('etat_sante', $animal->etat_sante) }}">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('animaux.index') }}" class="btn btn-secondary">❌ Annuler</a>
                <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection
