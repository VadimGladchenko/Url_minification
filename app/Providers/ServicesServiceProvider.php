<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->singleton(
            'App\Services\Interfaces\LinkServiceInterface',
            'App\Services\LinkService'
        );
    }
}