<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\UpgradeToHttpsUnderNgrok;
use App\Http\Middleware\SetCarOwner;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->append(UpgradeToHttpsUnderNgrok::class);
        $middleware->alias([
            'tenant' => SetCarOwner::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
