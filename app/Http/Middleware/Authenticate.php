<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * For API requests we don't want redirect-to-login (route('login') may not exist).
     * Make API unauthenticated requests return 401 JSON instead.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        // If it's an API/JSON request, return null so framework handles it as JSON auth failure.
        if ($request->expectsJson()) {
            return null;
        }

        // For non-API requests, abort with 401 (so it won't try to call route('login') which may not be defined)
        abort(401, 'Unauthorized');
    }
}
