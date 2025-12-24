@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">⚙️ Paramètres de l'exploitation</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Nom de la Ferme</label>
                        <input type="text" name="ferme_nom" class="form-control" value="{{ $settings['ferme_nom'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Devise (Monnaie)</label>
                        <input type="text" name="devise" class="form-control" value="{{ $settings['devise'] ?? 'FCFA' }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary rounded-pill">Sauvegarder</button>
            </form>
        </div>
    </div>
</div>
@endsection