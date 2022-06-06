<?php

namespace Customers\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class CustomerProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $directory_separator = DIRECTORY_SEPARATOR;

        config(['route' => File::getRequire(
            __DIR__ . $directory_separator .
            '..' . $directory_separator . 'config' . $directory_separator . 'routes.php'
        )]);

        $this->loadRoutesFrom(__DIR__ . $directory_separator .
            '..' . $directory_separator . 'routes' . $directory_separator . 'web.php');

    }
}