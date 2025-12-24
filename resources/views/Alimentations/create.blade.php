@extends('layouts.app')

@section('title', 'Ajouter une Alimentation')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">➕ Ajouter une Alimentation</h1>

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

    <form action="{{ route('alimentations.store') }}" method="POST">
        @csrf

        <!-- Type -->
        <div class="mb-3">
            <label for="type" class="form-label">Type d'alimentation</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <!-- Quantité -->
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="{{ old('quantite') }}" required>
        </div>

        <!-- Date -->
        <div class="mb-3">
            <label for="date_alimentation" class="form-label">Date d'alimentation</label>
            <input type="date" name="date_alimentation" id="date_alimentation" class="form-control" value="{{ old('date_alimentation') ?? date('Y-m-d') }}" required>
        </div>

        <!-- Animal -->
        <div class="mb-3">
            <label for="animal_id" class="form-label">Animal</label>
            <select name="animal_id" id="animal_id" class="form-select" required>
                <option value="">-- Sélectionner un animal --</option>
                @foreach($animals as $animal)
                    <option value="{{ $animal->id }}" {{ old('animal_id') == $animal->id ? 'selected' : '' }}>
                        {{ $animal->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('alimentations.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Retour
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
