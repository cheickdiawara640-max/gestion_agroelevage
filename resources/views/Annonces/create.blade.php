@extends('layouts.app')

@section('title', 'Nouvelle Annonce')

@section('content')
<h2><i class="bi bi-plus-circle"></i> Ajouter une Annonce</h2>

<form action="{{ route('annonces.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Publier</button>
    <a href="{{ route('annonces.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection
