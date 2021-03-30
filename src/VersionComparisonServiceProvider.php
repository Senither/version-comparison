<?php

namespace Senither\VersionComparison;

use Illuminate\Support\ServiceProvider;

class VersionComparisonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/version-comparison.php' => config_path('version-comparison.php'),
            ], 'config');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('version', function () {
            return new VersionManager;
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/version-comparison.php', 'version-comparison');
    }
}
