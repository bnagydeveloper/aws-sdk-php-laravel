<?php namespace Aws\Laravel;

use Aws\Sdk;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * AWS SDK for PHP service provider for Laravel applications
 */
class AwsServiceProvider extends ServiceProvider
{
    const VERSION = '1.3';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot()
    {
        $this->app['config']->package('aws/aws-sdk-php-laravel', __DIR__.'/../config', 'aws');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('aws', function ($app) {
            $config = $app->make('config')->get('aws');

            return new Sdk($config);
        });

        $this->app->alias('aws', 'Aws\Sdk');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['aws', 'Aws\Sdk'];
    }

}
