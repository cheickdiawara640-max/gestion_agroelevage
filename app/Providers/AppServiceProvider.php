<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Assurez-vous d'avoir cet import

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // En général, ce bloc est vide
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        // AUCUNE DÉFINITION DE GATE ICI
    }
}


