<?php

namespace bsm\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use bsm\Model\Koperasi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Koperasi::saving(function($model){
            $waktu = Carbon::now();
            $model->date_open = $waktu->format('Y-m-d H:i:s');
            $model->date_close = $waktu->addYear(1)->format('Y-m-d H:i:s');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
