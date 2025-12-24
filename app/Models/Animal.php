<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animals';

    // CORRECTION ICI : Utilise les noms de colonnes SQL (minuscules, pas d'accents, pas d'espaces)
    protected $fillable = [
        'nom',
        'race',
        'date_naissance',
        'sexe',
        'etat_sante',
        'pere_id',  // On remplace 'Père '
        'mere_id',  // On remplace 'Mère'
    ];

    // Relation pour le père
    public function pere()
    {
        return $this->belongsTo(Animal::class, 'pere_id');
    }

    // Relation pour la mère
    public function mere()
    {
        return $this->belongsTo(Animal::class, 'mere_id');
    }

    // Pour voir tous les enfants d'un animal
    public function enfants()
    {
        // On récupère les enfants où l'animal actuel est soit le père, soit la mère
        return Animal::where('pere_id', $this->id)->orWhere('mere_id', $this->id)->get();
    }
}