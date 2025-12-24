<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Http\Request;

class PreventRequestsDuringMaintenance
{
    /**
     * Gérer une requête entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Foundation\Http\Exceptions\MaintenanceModeException
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->isDownForMaintenance()) {
            throw new MaintenanceModeException(time());
        }

        return $next($request);
    }
}
