@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">👥 Gestion de l'équipe</h2>
        {{-- Bouton pour créer un NOUVEL utilisateur --}}
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Ajouter un membre
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Date d'inscription</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-danger">Administrateur</span>
                            @else
                                <span class="badge bg-info text-dark">Employé</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                {{-- BOUTON MODIFIER (Placé ici, il connaît l'utilisateur) --}}
                                @if(auth()->id() == 5)
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif

                                {{-- BOUTON SUPPRIMER --}}
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small">C'est vous</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection