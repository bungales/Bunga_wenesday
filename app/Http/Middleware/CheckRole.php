<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckIsLogin; // Import CheckIsLogin
use App\Http\Middleware\CheckRole; // Import CheckRole - TAMBAHAN BARU

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan CheckIsLogin dan CheckRole dengan alias
        $middleware->alias([
            'checkislogin' => CheckIsLogin::class,
            'checkrole' => CheckRole::class, // TAMBAHAN BARU - alias untuk CheckRole
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
