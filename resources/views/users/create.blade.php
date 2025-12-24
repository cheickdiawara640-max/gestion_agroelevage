@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Créer un nouvel utilisateur</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nom complet</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Rôle</label>
                            <select name="is_admin" class="form-select">
                                <option value="0">Employé (Accès restreint)</option>
                                <option value="1">Administrateur (Accès total)</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enregistrer l'utilisateur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection