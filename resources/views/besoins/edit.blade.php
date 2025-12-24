@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Modifier un besoin</h1>

    <form action="{{ route('besoins.update', $besoin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Titre :</label>
        <input type="text" name="titre" value="{{ $besoin->titre }}" class="form-control" required><br>

        <label>Montant :</label>
        <input type="number" step="0.01" name="montant" value="{{ $besoin->montant }}" class="form-control" required><br>

        <label>Date de demande :</label>
        <input type="date" name="date_demande" value="{{ $besoin->date_demande }}" class="form-control" required><br>

        <label>Description :</label>
        <textarea name="description" class="form-control">{{ $besoin->description }}</textarea><br>

        <button class="btn btn-primary">Modifier</button>
        <a href="{{ route('besoins.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
