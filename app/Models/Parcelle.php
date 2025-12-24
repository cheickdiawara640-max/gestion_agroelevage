<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcelle extends Model
{
    protected $fillable = ['nom', 'superficie', 'localisation'];

    public function recoltes()
{
    return $this->hasMany(Recolte::class);
}

}
