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
        $ds = DIRECTORY_SEPARATOR;

        $moduleName = 'suppliers';

        config(['supplierRoute' => File::getRequire(
            __DIR__ . $ds .
            '..' . $ds . 'config' . $ds . 'routes.php'
        )]);

        $this->loadRoutesFrom(__DIR__ . $ds .
            '..' . $ds . 'routes' . $ds . 'web.php');

        $this->loadViewsFrom
            (__DIR__ . $ds . '..' . $ds . 'resources' . $ds . 'views', $moduleName);

    }
}