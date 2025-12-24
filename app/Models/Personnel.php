<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = [
        'nom',
        'poste',
        'salaire',
        'telephone',
        'date_recrutement',
    ];

    // ⚠️ Important : pour que date_recrutement soit manipulable avec ->format()
    protected $dates = ['date_recrutement'];
}
