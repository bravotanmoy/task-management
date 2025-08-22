<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Tymon\JWTAuth\Http\Middleware\Authenticate as JwtAuthenticate;

return Application::configure(basePath: dirname(__DIR__))
    // Middleware registration
    ->withMiddleware(function (Middleware $middleware) {
        // Alias for JWT middleware
        $middleware->alias([
            'auth.api' => JwtAuthenticate::class,
        ]);

        // Apply JWT middleware automatically to API routes (optional)
        $middleware->api(append: [
            JwtAuthenticate::class,
        ]);
    })

    // Exception handling
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, $request) {
            // Force JSON response for API routes
            if ($request->is('api/*')) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        });
    })

    ->create();
