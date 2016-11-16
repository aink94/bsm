<?php

namespace Bsm\Rfid;

use Illuminate\Support\ServiceProvider;

class RfidServiceProvider extends ServiceProvider
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
        include __DIR__.'/routes.php';

        $this->app->make("Bsm\Rfid\RfidController");
    }
}
