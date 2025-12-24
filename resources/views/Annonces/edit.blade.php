@extends('layouts.app')

@section('title', 'Modifier Annonce')

@section('content')
<h2><i class="bi bi-pencil"></i> Modifier Annonce</h2>

<form action="{{ route('annonces.update', $annonce) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" value="{{ $annonce->titre }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" id="message" rows="4" class="form-control" required>{{ $annonce->message }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <a href="{{ route('annonces.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
