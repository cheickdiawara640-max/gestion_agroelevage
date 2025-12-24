<?php

// app/Models/Traitement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;

    protected $fillable = [
        'culture_id',
        'parcelle_id',
        'nom_produit',
        'type_produit',
        'dose',
        'unite_dose',
        'date_application',
        'notes',
        'date_recolte_attendue',
        'appliquer_par',
    ];

    // Relations
    public function culture()
    {
        return $this->belongsTo(Culture::class);
    }

    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
}
