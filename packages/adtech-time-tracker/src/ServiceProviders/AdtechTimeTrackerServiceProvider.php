<?php

namespace Adtech\AdtechTimeTracker\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class AdtechTimeTrackerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'adtech-time-tracker');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'adtech-time-tracker');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('adtech-time-tracker.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/adtech-time-tracker'),
            ], 'views');*/

            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/adtech-time-tracker'),
            ], 'assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/adtech-time-tracker'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'adtech-time-tracker');

        // Register the main class to use with the facade
        $this->app->singleton('adtech-time-tracker', function () {
            return new AdtechTimeTracker;
        });
    }
}
