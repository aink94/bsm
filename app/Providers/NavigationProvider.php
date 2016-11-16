<?php

namespace bsm\Providers;

use bsm\Helpers\Navigation\Navigation;
use Illuminate\Support\ServiceProvider;

class NavigationProvider extends ServiceProvider
{
    protected $defer = true;
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
        $this->app->bind('bsm\Helpers\Navigation\Contract\NavigationContract', function(){
            return new Navigation();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bsm\Helpers\Navigation\Contract\NavigationContract'];
    }

}
