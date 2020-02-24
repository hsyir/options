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

        \App::bind('Options', function () {
            return new Options();
        });


        $this->mergeConfigFrom(__DIR__ . '/../resources/config/options.php', 'options');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
          $this->loadViewsFrom(__DIR__.'/../resources/views', 'siteOptions');
        /*
                  $this->publishes([
                      __DIR__ . '/../resources/config/tenancyManager.php' => config_path('tenancyManager.php'),
                  ], 'config');

                  $this->publishes([
                      __DIR__.'/../resources/views' => resource_path('views/vendor/tenancyManager'),
                  ], 'views');

          */

        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');

    }
}
