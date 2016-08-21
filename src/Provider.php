<?php

namespace Weirongxu\LaravelQueryRoute;

use Illuminate\Support\ServiceProvider;
use Exception;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->bound('routes')) {
            throw new Exception('routes provider must register before query-route');
        }
        $this->app['url'] = $this->app->share(function($app) {
            return new UrlGenerator($app['routes'], $app['request']);
        });

        $this->publishes(__DIR__ . '/../config/query-route.php', config_path('query-route.php'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
