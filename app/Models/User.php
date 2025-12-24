<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

// app/Models/User.php

// ...
class User extends Authenticatable
{
    // ...
    protected $fillable = [
        'name',
        'email',
        'is_admin', // <-- AJOUTÉ
        'password',
    ];
    // ...
    public function isAdmin()
{
    return $this->is_admin == 1|| $this->is_admin === true;
}
    
}
