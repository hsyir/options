<?php

namespace Hsy\Options;

use Illuminate\Support\ServiceProvider as SP;

class ServiceProvider extends SP
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/options.php', 'options');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/options.php' => config_path('options.php'),], 'config');

        $this->publishes([
            __DIR__.'/../database/' => database_path('migrations')
        ], 'migrations');
    }
}
