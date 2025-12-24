@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">✍️ Modifier la Vente #{{ $vente->id }} ({{ $vente->produit_vendu }})</h2>
        <a href="{{ route('ventes.index') }}" class="btn btn-secondary">
            < Retour à la Liste des Ventes
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
            <form action="{{ route('ventes.update', $vente->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h4 class="mb-3 border-bottom pb-2">Détails de la Transaction</h4>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="recolte_id" class="form-label">Récolte Associée:</label>
                        <select class="form-select" id="recolte_id" name="recolte_id" required>
                            <option value="">-- Sélectionner la Récolte d'origine --</option>
                            @foreach ($recoltes as $recolte)
                                <option value="{{ $recolte->id }}" 
                                    {{ old('recolte_id', $vente->recolte_id) == $recolte->id ? 'selected' : '' }}>
                                    #{{ $recolte->id }} - {{ $recolte->culture }} ({{ $recolte->quantite }} {{ $recolte->unite }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="date_vente" class="form-label">Date de la Vente:</label>
                        <input type="date" class="form-control" id="date_vente" name="date_vente" 
                               value="{{ old('date_vente', $vente->date_vente) }}" required>
                    </div>
                    
                    <div class="col-12">
                        <label for="produit_vendu" class="form-label">Nom du Produit Vendu (Ex: Maïs Grain, Tomates Réfusées):</label>
                        <input type="text" class="form-control" id="produit_vendu" name="produit_vendu" 
                               value="{{ old('produit_vendu', $vente->produit_vendu) }}" required>
                    </div>
                </div>

                <h4 class="mb-3 border-bottom pb-2">Quantités et Prix</h4>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="quantite_vendue" class="form-label">Quantité Vendue:</label>
                        <input type="number" step="0.01" class="form-control" id="quantite_vendue" name="quantite_vendue" 
                               value="{{ old('quantite_vendue', $vente->quantite_vendue) }}" oninput="calculerMontant()" required>
                    </div>

                    <div class="col-md-2">
                        <label for="unite_quantite" class="form-label">Unité (ex: Kg, Sac):</label>
                        <input type="text" class="form-control" id="unite_quantite" name="unite_quantite" 
                               value="{{ old('unite_quantite', $vente->unite_quantite) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="prix_unitaire" class="form-label">Prix Unitaire (F):</label>
                        <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire" 
                               value="{{ old('prix_unitaire', $vente->prix_unitaire) }}" oninput="calculerMontant()" required>
                    </div>

                    <div class="col-md-3">
                        <label for="montant_total" class="form-label">Montant Total (F):</label>
                        <input type="number" step="0.01" class="form-control fw-bold bg-light" id="montant_total" name="montant_total" 
                               value="{{ old('montant_total', $vente->montant_total) }}" readonly required>
                    </div>
                </div>

                <h4 class="mb-3 border-bottom pb-2">Modalités</h4>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="mode_vente" class="form-label">Mode de Vente:</label>
                        <select class="form-select" id="mode_vente" name="mode_vente" required>
                            <option value="">-- Choisir un mode --</option>
                            <option value="Vente Directe" {{ old('mode_vente', $vente->mode_vente) == 'Vente Directe' ? 'selected' : '' }}>Vente Directe (ferme, marché)</option>
                            <option value="Grossiste" {{ old('mode_vente', $vente->mode_vente) == 'Grossiste' ? 'selected' : '' }}>Grossiste / Intermédiaire</option>
                            <option value="Exportation" {{ old('mode_vente', $vente->mode_vente) == 'Exportation' ? 'selected' : '' }}>Exportation</option>
                            <option value="Transformation Interne" {{ old('mode_vente', $vente->mode_vente) == 'Transformation Interne' ? 'selected' : '' }}>Transformation Interne</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="mode_paiement" class="form-label">Mode de Paiement:</label>
                        <select class="form-select" id="mode_paiement" name="mode_paiement">
                            <option value="">-- Non spécifié --</option>
                            <option value="Espèces" {{ old('mode_paiement', $vente->mode_paiement) == 'Espèces' ? 'selected' : '' }}>Espèces</option>
                            <option value="Virement" {{ old('mode_paiement', $vente->mode_paiement) == 'Virement' ? 'selected' : '' }}>Virement Bancaire</option>
                            <option value="Chèque" {{ old('mode_paiement', $vente->mode_paiement) == 'Chèque' ? 'selected' : '' }}>Chèque</option>
                            <option value="Crédit" {{ old('mode_paiement', $vente->mode_paiement) == 'Crédit' ? 'selected' : '' }}>Crédit / Paiement différé</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="client_nom" class="form-label">Nom du Client (Optionnel):</label>
                        <input type="text" class="form-control" id="client_nom" name="client_nom" value="{{ old('client_nom', $vente->client_nom) }}">
                    </div>

                    <div class="col-12">
                        <label for="notes" class="form-label">Notes / Remarques:</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $vente->notes) }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning btn-lg shadow-sm me-2">
                        <i class="fas fa-sync-alt"></i> Mettre à jour la Vente
                    </button>
                    <a href="{{ route('ventes.show', $vente->id) }}" class="btn btn-danger btn-lg shadow-sm">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    /**
     * Calcule le montant total de la vente (Quantité * Prix Unitaire)
     */
    function calculerMontant() {
        const quantite = parseFloat(document.getElementById('quantite_vendue').value) || 0;
        const prixUnitaire = parseFloat(document.getElementById('prix_unitaire').value) || 0;
        const montantTotal = quantite * prixUnitaire;
        
        // Afficher le résultat avec 2 décimales
        document.getElementById('montant_total').value = montantTotal.toFixed(2);
    }

    // Assure le calcul initial lors du chargement de la page d'édition
    document.addEventListener('DOMContentLoaded', calculerMontant);
</script>
@endsection