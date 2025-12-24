<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimentation extends Model
{
    protected $fillable = [
        'type',
        'description',
        'quantite',
        'date_alimentation',
        'animal_id'
    ];



    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
