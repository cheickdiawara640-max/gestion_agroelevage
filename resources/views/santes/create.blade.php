@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>➕ Ajouter un suivi santé</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li> 
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('santes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du suivi santé</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="diagnostic" class="form-label">Diagnostic</label>
            <textarea name="diagnostic" id="diagnostic" class="form-control" required>{{ old('diagnostic') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="traitement" class="form-label">Traitement</label>
            <textarea name="traitement" id="traitement" class="form-control">{{ old('traitement') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
        </div>

        <div class="mb-3">
            <label for="animal_id" class="form-label">Animal</label>
            <select name="animal_id" id="animal_id" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                @foreach($animals as $animal)
                    <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                        {{ $animal->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">💾 Enregistrer</button>
        <a href="{{ route('santes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
