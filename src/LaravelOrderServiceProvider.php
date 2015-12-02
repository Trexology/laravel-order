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
    }

    protected function registerServices() {
      $this->app->bind('order', function ($app) {
        return new Model\Order;
      });
    }
}
