<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

    $middleware->alias([
        'custom.auth' => \App\Http\Middleware\CustomAuth::class,
    ]);

})

    ->withExceptions(function (Exceptions $exceptions): void {

    $exceptions->render(function (
        AuthenticationException $e,
        Request $request
    ) {

        return response()->json([
            'status' => false,
            'message' => 'Token tidak valid atau belum login'
        ], 401);

    });

})->create();