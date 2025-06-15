<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\AdminMiddleware; // <-- Baris ini yang diubah

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login'); // Contoh default dari Laravel 11

        $middleware->alias([
            'admin' => AdminMiddleware::class, // <-- Pastikan ini menunjuk ke kelas middleware Anda
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();