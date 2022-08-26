<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GeneratorWidgetPacksForDelivery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('GeneratorWidgetPacksForDelivery', function(){
            return new GeneratorWidgetPacksForDelivery(config('deliveyGenerator.avaliablePackSizes'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
