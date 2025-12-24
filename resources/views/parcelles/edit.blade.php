@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier une parcelle</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('parcelles.update', $parcelle->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 10px;">
            <label for="nom">Nom :</label><br>
            <input type="text" name="nom" id="nom" value="{{ $parcelle->nom }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="superficie">Superficie (ha) :</label><br>
            <input type="number" step="0.01" name="superficie" id="superficie" value="{{ $parcelle->superficie }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="localisation">Localisation :</label><br>
            <input type="text" name="localisation" id="localisation" value="{{ $parcelle->localisation }}" required>
        </div>

        <button type="submit" style="background-color: #2196F3; color: white; padding: 8px 12px; border: none; cursor: pointer;">Mettre à jour</button>
        <a href="{{ route('parcelles.index') }}" style="margin-left: 10px; color: #555;">Annuler</a>
    </form>
</div>
@endsection
