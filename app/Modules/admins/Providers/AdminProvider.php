<?php

namespace Admins\Providers;

use Illuminate\Support\ServiceProvider;

class AdminProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__ . $directory_separator .
            '..' . $directory_separator . 'routes' . $directory_separator . 'web.php');
    }
}