<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

if (isset($_SERVER['VERCEL_DIR'])) {
    $compiledPath = '/tmp/storage/framework/views';
    if (!is_dir($compiledPath)) {
        mkdir($compiledPath, 0755, true);
    }
    $app->useStoragePath('/tmp/storage');
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
