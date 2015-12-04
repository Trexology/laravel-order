<?php

namespace Trexology\LaravelOrder;
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 15/7/27
 * Time: 上午11:19
 */

use Illuminate\Support\ServiceProvider;

class LaravelOrderServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAssets();
        $this->registerServices();
    }

    public function registerAssets()
    {
        $this->publishes([
            __DIR__.'/../migrations/' => database_path('/migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('order.php')
        ], 'config');
    }

    protected function registerServices() {
      $this->app->bind('order', function ($app) {
        return new Model\Order;
      });

      $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'order');
    }

    /**
     * Helper to get the config values
     *
     * @param  string $key
     * @return string
     */
    protected function config($key, $default = null)
    {
        return config("order.$key", $default);
    }

    /**
     * Get an instantiable configuration instance. Pinched from dingo/api :)
     *
     * @param  mixed  $instance
     * @return object
     */
    protected function getConfigInstance($instance)
    {
        if (is_callable($instance)) {
            return call_user_func($instance, $this->app);
        } elseif (is_string($instance)) {
            return $this->app->make($instance);
        }

        return $instance;
    }
}
