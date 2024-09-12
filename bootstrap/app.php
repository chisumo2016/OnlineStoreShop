<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            /**Admin */
            Route::middleware(['web','auth', 'role:admin'])
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            /**Vendor */
            Route::middleware(['web','auth', 'role:vendor'])
                ->prefix('vendor')
                ->as('vendor.')
                ->group(base_path('routes/vendor.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {

        /**Role Middleware */
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
