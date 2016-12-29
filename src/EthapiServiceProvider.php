<?php

namespace Charonne\Ethapi;

use Illuminate\Support\ServiceProvider;

class EthapiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes/api.php';
        $this->app->make('Charonne\Ethapi\Controllers\CallbackController');

        //
        // $this->registerEthapi();
        // $this->app->alias('ethapi', 'Charonne\Ethapi\Ethapi');
    }


 /**
     * Register the EthApi instance.
     *
     * @return void
     */
    protected function registerEthapi()
    {
        $this->app->singleton('ethapi', function ($app) {
            return new EthApi();
        });
    }

}
