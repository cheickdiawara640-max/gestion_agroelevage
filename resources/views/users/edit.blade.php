@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">✍️ Modifier l'Utilisateur: {{ $user->name }}</h2>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            < Retour à la Liste
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h4 class="mb-3 border-bottom pb-2">Informations Générales</h4>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <h4 class="mb-3 border-bottom pb-2">Gestion des Permissions</h4>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" 
                           value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_admin">
                        Attribuer les droits **Administrateur**
                    </label>
                    <small class="form-text text-muted d-block">L'administrateur a accès à toutes les données et peut gérer les autres utilisateurs.</small>
                </div>
                
                <h4 class="mb-3 border-bottom pb-2">Changer le Mot de Passe (Optionnel)</h4>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Nouveau Mot de Passe:</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        <small class="form-text text-muted">Laissez vide pour ne pas changer le mot de passe.</small>
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmer le Mot de Passe:</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning btn-lg shadow-sm">
                        <i class="fas fa-sync-alt"></i> Mettre à jour l'Utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection