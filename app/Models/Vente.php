<?php

// app/Models/Vente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'recolte_id',
        'date_vente',
        'produit_vendu',
        'quantite_vendue',
        'unite_quantite',
        'prix_unitaire',
        'montant_total',
        'mode_vente',
        'mode_paiement',
        'client_nom',
        'notes',
    ];

    // Relation
    public function recolte()
    {
        return $this->belongsTo(Recolte::class);
    }
}