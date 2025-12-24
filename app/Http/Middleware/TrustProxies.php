<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Liste des proxys à faire confiance.
     *
     * @var array|string|null
     */
    protected $proxies = '*';  // ou null selon ta configuration

    /**
     * Les en-têtes proxy à utiliser.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
