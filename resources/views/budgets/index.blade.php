@extends('layouts.app')

@section('title', 'Liste des Budgets')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>💰 Budgets</h2>
        <a href="{{ route('budgets.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouveau budget
        </a>
    </div>

    <div class="mb-3">
        <a href="{{ route('budgets.export.pdf') }}" class="btn btn-secondary">
            📄 Exporter PDF
        </a>
        <a href="{{ route('budgets.export.excel') }}" class="btn btn-success">
            📊 Exporter Excel
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($budgets as $budget)
                <tr>
                    <td>{{ $budget->id }}</td>
                    <td>{{ $budget->nom }}</td>
                    <td>{{ number_format($budget->montant, 0, ',', ' ') }} FCFA</td>
                    <td>{{ \Carbon\Carbon::parse($budget->date)->format('d/m/Y') }}</td>
                    <td>{{ $budget->description }}</td>
                    <td>
                        <a href="{{ route('budgets.edit', $budget) }}" class="btn btn-warning btn-sm">
                            ✏️ Modifier
                        </a>
                        <form action="{{ route('budgets.destroy', $budget) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce budget ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun budget trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
