<?php

namespace Chriha\LaravelTracking;

use Chriha\LaravelTracking\Http\Middleware\Tracking;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class TrackingServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom( __DIR__ . "/Migrations" );
    }

    /**
     * Bootstrap services.
     *
     * @param Router $router
     * @return void
     */
    public function boot( Router $router )
    {
        $router->pushMiddlewareToGroup( 'web', Tracking::class );
        $router->pushMiddlewareToGroup( 'api', Tracking::class );

        $this->publishes( [
            __DIR__ . '/Config/tracking.php' => config_path( 'tracking.php' )
        ] );
    }
}
