<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
   protected $fillable = [
    'titre',
    'montant',
    'date_demande',
    'description',
    'statut',
];

}
