@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-success text-white p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">🧾 Facture #{{ $vente->id }}</h3>
                <span class="badge bg-white text-success fs-6">PAYÉ</span>
            </div>
        </div>
        <div class="card-body p-5">
            <div class="row mb-5">
                <div class="col-6">
                    <p class="text-muted mb-1">Vendu à :</p>
                    <h5 class="fw-bold">{{ $vente->client ?? 'Client Comptant' }}</h5>
                </div>
                <div class="col-6 text-end">
                    <p class="text-muted mb-1">Date de transaction :</p>
                    <h5 class="fw-bold">{{ \Carbon\Carbon::parse($vente->created_at)->format('d/m/Y H:i') }}</h5>
                </div>
            </div>

            <table class="table table-borderless">
                <thead class="border-bottom">
                    <tr>
                        <th>Désignation</th>
                        <th class="text-center">Quantité</th>
                        <th class="text-end">Prix Unitaire</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $vente->produit_nom ?? 'Produit agricole' }}</td>
                        <td class="text-center">{{ $vente->quantite }}</td>
                        <td class="text-end">{{ number_format($vente->prix_unitaire, 0, ',', ' ') }} F</td>
                        <td class="text-end fw-bold">{{ number_format($vente->montant_total, 0, ',', ' ') }} F</td>
                    </tr>
                </tbody>
                <tfoot class="border-top">
                    <tr>
                        <td colspan="3" class="text-end fs-5 fw-bold">TOTAL GÉNÉRAL :</td>
                        <td class="text-end fs-5 fw-bold text-success">{{ number_format($vente->montant_total, 0, ',', ' ') }} CFA</td>
                    </tr>
                </tfoot>
            </table>

            <div class="mt-5 d-flex gap-2">
                <button onclick="window.print()" class="btn btn-primary"><i class="bi bi-printer"></i> Imprimer le reçu</button>
                <a href="{{ route('ventes.index') }}" class="btn btn-light border">Retour aux ventes</a>
            </div>
        </div>
    </div>
</div>
@endsection