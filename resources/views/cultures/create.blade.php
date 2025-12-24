@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 20px; max-width: 600px;">

    <h1>Ajouter une culture</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cultures.store') }}" method="POST">
        @csrf

        <!-- NOM -->
        <div style="margin-bottom: 15px;">
            <label for="nom">Nom :</label><br>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required style="width: 100%; padding: 8px;">
        </div>

        <!-- TYPE -->
        <div style="margin-bottom: 15px;">
            <label for="type">Type :</label><br>
            <select name="type" id="type" required style="width: 100%; padding: 8px;">
                <option value="">-- Sélectionner un type --</option>
                <option value="plante" {{ old('type') == 'plante' ? 'selected' : '' }}>Plante</option>
                <option value="arbre" {{ old('type') == 'arbre' ? 'selected' : '' }}>Arbre</option>
                <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>

        <!-- PARCELLE -->
        <div style="margin-bottom: 15px;">
            <label for="parcelle_id">Parcelle :</label><br>
            <select name="parcelle_id" id="parcelle_id" required style="width: 100%; padding: 8px;">
                <option value="">-- Sélectionner une parcelle --</option>
                @foreach($parcelles as $parcelle)
                    <option value="{{ $parcelle->id }}" {{ old('parcelle_id') == $parcelle->id ? 'selected' : '' }}>
                        {{ $parcelle->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- PERIODE SEMIS -->
        <div style="margin-bottom: 15px;">
            <label for="periode_semis">Date de semis :</label><br>
            <input type="date" name="periode_semis" id="periode_semis" value="{{ old('periode_semis') }}" required style="width: 100%; padding: 8px;">
        </div>

        <!-- PERIODE RECOLTE -->
        <div style="margin-bottom: 15px;">
            <label for="periode_recolte">Date de récolte :</label><br>
            <input type="date" name="periode_recolte" id="periode_recolte" value="{{ old('periode_recolte') }}" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; cursor: pointer; border-radius: 5px;">
            Enregistrer
        </button>
        <a href="{{ route('cultures.index') }}" style="margin-left: 10px; color: #555;">Annuler</a>
    </form>
</div>
@endsection
