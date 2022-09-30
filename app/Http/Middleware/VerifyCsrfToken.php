<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // 'stripe/*',
        '/api/customers',
        '/api/reservesall',
        '/api/reservesall/{id}',
        // 'http://example.com/foo/*',
    ];
}
