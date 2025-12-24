@extends('layouts.app')

@section('title', 'Modifier un suivi santé')

@section('content')
<div class="container py-4">
    <h3>✏️ Modifier le suivi santé</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('santes.update', $sante->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nom du suivi / vétérinaire -->
        <div class="mb-3">
            <label class="form-label" for="nom">Nom du suivi / vétérinaire</label>
            <input type="text" id="nom" name="nom" class="form-control"
                   value="{{ old('nom', $sante->nom) }}" required>
        </div>

        <!-- Sélection de l'animal -->
        <div class="mb-3">
            <label class="form-label" for="animal_id">Animal</label>
            <select id="animal_id" name="animal_id" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                @foreach($animals as $animal)
                    <option value="{{ $animal->id }}" {{ $sante->animal_id == $animal->id ? 'selected' : '' }}>
                        {{ $animal->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Diagnostic -->
        <div class="mb-3">
            <label class="form-label" for="diagnostic">Diagnostic</label>
            <input type="text" id="diagnostic" name="diagnostic" class="form-control" 
                   value="{{ old('diagnostic', $sante->diagnostic) }}" required>
        </div>

        <!-- Traitement -->
        <div class="mb-3">
            <label class="form-label" for="traitement">Traitement</label>
            <input type="text" id="traitement" name="traitement" class="form-control" 
                   value="{{ old('traitement', $sante->traitement) }}">
        </div>

        <!-- Date -->
        <div class="mb-3">
            <label class="form-label" for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" 
                   value="{{ old('date', isset($sante->date) ? \Carbon\Carbon::parse($sante->date)->format('Y-m-d') : '') }}" 
                   required>
        </div>

        <button type="submit" class="btn btn-success">💾 Mettre à jour</button>
        <a href="{{ route('santes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
