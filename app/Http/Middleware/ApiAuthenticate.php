<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ApiAuthenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // Jangan redirect, balikin error JSON aja
        if ($request->expectsJson()) {
            return null;
        }

        abort(401, 'Unauthorized');
    }
}
