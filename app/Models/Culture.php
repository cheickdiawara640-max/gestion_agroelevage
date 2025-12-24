<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'periode_semis',
        'periode_recolte',
        'parcelle_id',
    ];

    // Relation vers la parcelle
    public function parcelle()
    {
        return $this->belongsTo(Parcelle::class);
    }
}
