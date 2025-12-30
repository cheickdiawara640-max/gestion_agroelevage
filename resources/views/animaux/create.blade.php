@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4 rounded-4">
        <h2 class="mb-4 text-center">Ajouter un animal</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('animaux.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l’animal</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
            </div>

            <div class="mb-3">
                <label for="race" class="form-label">Race</label>
                <input type="text" class="form-control" id="race" name="race" value="{{ old('race') }}">
            </div>

            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
            </div>

            <div class="mb-3">
                <label for="sexe" class="form-label">Sexe</label>
                <select class="form-select" id="sexe" name="sexe">
                    <option value="">-- Sélectionner --</option>
                    <option value="Mâle" {{ old('sexe') == 'Mâle' ? 'selected' : '' }}>Mâle</option>
                    <option value="Femelle" {{ old('sexe') == 'Femelle' ? 'selected' : '' }}>Femelle</option>
                </select>
            </div>

           <div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Père</label>
        <select name="pere_id" class="form-select">
            <option value="">-- Aucun (Inconnu) --</option>
            @foreach($peres as $p)
                <option value="{{ $p->id }}">{{ $p->nom }} ({{ $p->race }})</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Mère</label>
        <select name="mere_id" class="form-select">
            <option value="">-- Aucune (Inconnue) --</option>
            @foreach($meres as $m)
                <option value="{{ $m->id }}">{{ $m->nom }} ({{ $m->race }})</option>
            @endforeach
        </select>
    </div>
</div>
            <div class="mb-3">
                <label for="etat_sante" class="form-label">État de santé (optionnel)</label>
                <input type="text" class="form-control" id="etat_sante" name="etat_sante" value="{{ old('etat_sante') }}">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('animaux.index') }}" class="btn btn-secondary px-4">❌ Annuler</a>
                <button type="submit" class="btn btn-success px-4">💾 Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection