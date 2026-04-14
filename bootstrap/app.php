<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SetLanguage;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        // $middleware->append(SetLanguage::class);

        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'owner_hub' => \App\Http\Middleware\OwnerHubMiddleware::class,
            'set_language' => SetLanguage::class,
        ]);
        $middleware->web(SetLanguage::class);
        // $middleware->api(SetLanguage::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
