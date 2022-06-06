<?php

namespace Suppliers\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class SupplierProvider extends ServiceProvider
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

        config(['supplierRoute' => File::getRequire(
            __DIR__ . $directory_separator .
            '..' . $directory_separator . 'config' . $directory_separator . 'routes.php'
        )]);

        $this->loadRoutesFrom(__DIR__ . $directory_separator .
            '..' . $directory_separator . 'routes' . $directory_separator . 'web.php');
    }
}