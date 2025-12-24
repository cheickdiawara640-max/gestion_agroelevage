<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recolte extends Model
{
    // Colonnes que l'on peut remplir en mass-assignment
    protected $fillable = [
        'parcelle_id',
        'culture',
        'quantite',
        'date_recolte',
        'remarques'
    ];

    // Dates à traiter comme instances Carbon
    protected $dates = ['date_recolte'];

    // Relation avec Parcelle
    public function parcelle(): BelongsTo
    {
        return $this->belongsTo(Parcelle::class);
    }
}
