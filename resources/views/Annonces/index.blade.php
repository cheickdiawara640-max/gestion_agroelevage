{{-- resources/views/annonces/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Liste des annonces</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($annonces->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annonces as $annonce)
                    <tr>
                        <td>{{ $annonce->id }}</td>
                        <td>{{ $annonce->titre }}</td>
                        <td>{{ $annonce->message }}</td>
                        <td>
                            <a href="{{ route('annonces.show', $annonce) }}" class="btn btn-primary btn-sm">Voir</a>
                            <a href="{{ route('annonces.edit', $annonce) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cette annonce ?')" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $annonces->links() }}
    @else
        <p>Aucune annonce trouvée.</p>
    @endif

    <a href="{{ route('annonces.create') }}" class="btn btn-success">Ajouter une annonce</a>
</div>
@endsection
