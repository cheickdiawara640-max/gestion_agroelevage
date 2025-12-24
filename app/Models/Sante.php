<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sante extends Model
{
    use HasFactory;

    // Les champs autorisés à la création/mise à jour
    protected $fillable = ['nom', 'diagnostic', 'traitement', 'date', 'animal_id'];

    // Relation vers l'animal
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
