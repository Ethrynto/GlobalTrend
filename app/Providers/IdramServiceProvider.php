<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class IdramServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('idram', function ($app) {
            return new Client([
                'base_uri' => env('IDRAM_BASE_URI', 'https://api.idram.am/payment/servlet/'),
                'timeout'  => 5.0,
            ]);
        });
    }

    public function boot()
    {
        //
    }
}
