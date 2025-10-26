<?php
// ไฟล์: bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware; // import Middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) { // <-- หาฟังก์ชันนี้
        
        // $middleware->alias([...])
        // คือการตั้ง "ชื่อเล่น" (alias) ให้กับ Middleware ของเรา
        // เราตั้งชื่อเล่น 'role' ให้เรียกใช้คลาส \App\Http\Middleware\CheckRole::class
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // ...
    })->create();
