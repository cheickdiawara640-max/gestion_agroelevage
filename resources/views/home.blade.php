@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">👋 Bienvenue sur votre espace</h4>
                </div>
                <div class="card-body text-center p-5">
                    <h3>Bonjour, {{ Auth::user()->name }} !</h3>
                    <p class="text-muted">Vous êtes connecté en tant qu'utilisateur de la plateforme de gestion d'agro-élevage.</p>
                    <hr>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('animaux.index') }}" class="btn btn-outline-primary btn-lg">
                            🐄 Gérer les Animaux
                        </a>
                        <a href="{{ route('parcelles.index') }}" class="btn btn-outline-success btn-lg">
                            🌱 Voir les Parcelles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection