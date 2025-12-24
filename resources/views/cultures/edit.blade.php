@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier une culture</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cultures.update', $culture->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 10px;">
            <label for="nom">Nom :</label><br>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $culture->nom) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="type">Type :</label><br>
            <select name="type" id="type" required>
                <option value="">-- Sélectionner un type --</option>
                <option value="plante" {{ old('type', $culture->type) == 'plante' ? 'selected' : '' }}>Plante</option>
                <option value="arbre" {{ old('type', $culture->type) == 'arbre' ? 'selected' : '' }}>Arbre</option>
                <option value="autre" {{ old('type', $culture->type) == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="parcelle_id">Parcelle :</label><br>
