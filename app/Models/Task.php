<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    // On autorise Laravel à remplir ces colonnes
    protected $fillable = [
        'titre', 
        'date_echeance', 
        'priorite', 
        'est_terminee'
    ];

    // Pour que Laravel traite la date correctement
    protected $casts = [
        'date_echeance' => 'date',
        'est_terminee' => 'boolean',
    ];
}