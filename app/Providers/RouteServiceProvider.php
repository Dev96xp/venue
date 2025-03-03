<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    //public const HOME = '/dashboard';
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // 'auth' - Pedira que me autentifique para poder entrar a todas rutas
            // definidas bajo este archivo admin.php
            Route::middleware('web', 'auth')
                ->name('admin.')    //Las ruta va a comenzar con (admin.)
                ->prefix('admin')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            // 'auth' - Pedira que me autentifique para poder entrar a todas rutas
            // definidas bajo este archivo admin.php
            Route::middleware('web', 'auth')
                ->name('sales.')    //Las ruta va a comenzar con (sales.)
                ->prefix('sales')
                ->namespace($this->namespace)
                ->group(base_path('routes/sales.php'));

            Route::middleware('web', 'auth')
                ->name('account.')    //Las ruta va a comenzar con (account.)
                ->prefix('account')
                ->namespace($this->namespace)
                ->group(base_path('routes/account.php'));

            Route::middleware('web', 'auth')
                ->name('photography.')    //Las ruta va a comenzar con (photography.)
                ->prefix('photography')
                ->namespace($this->namespace)
                ->group(base_path('routes/photography.php'));
        });
    }
}
