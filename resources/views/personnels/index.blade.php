@extends('layouts.app')

@section('title', 'Liste des Personnels')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">👥 Liste des Personnels</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('personnels.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un personnel
        </a>

        <div>
            <a href="{{ route('personnels.export.pdf') }}" class="btn btn-secondary">
                <i class="bi bi-file-earmark-pdf"></i> PDF
            </a>
            <a href="{{ route('personnels.export.excel') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Excel
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Poste</th>
                    <th>Salaire</th>
                    <th>Téléphone</th>
                    <th>Date Recrutement</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($personnels as $personnel)
                    <tr>
                        <td>{{ $personnel->id }}</td>
                        <td>{{ $personnel->nom }}</td>

                        <td>{{ $personnel->poste ?: '—' }}</td>

                        <td>
                            @if($personnel->salaire)
                                {{ number_format($personnel->salaire, 0, ',', ' ') }} FCFA
                            @else
                                —
                            @endif
                        </td>

                        <td>{{ $personnel->telephone ?: '—' }}</td>

                        <td>
                            {{ $personnel->date_recrutement ? \Carbon\Carbon::parse($personnel->date_recrutement)->format('d/m/Y') : '—' }}
                        </td>

                        <td>
                            <a href="{{ route('personnels.edit', $personnel->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('personnels.destroy', $personnel->id) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Supprimer ce personnel ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-3">Aucun personnel trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
