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
        //$moduleName = 'customers';
        $moduleName = basename(dirname(__DIR__, 1));
        // dd($moduleName);
        config([$moduleName => File::getRequire(loadConfig($moduleName, 'routes.php'))]);
        $this->loadRoutesFrom(loadRoutePath($moduleName, 'web.php'));
        $this->loadViewsFrom(loadViewsPath($moduleName), $moduleName);
        $this->loadMigrationsFrom(loadMigrationsPath($moduleName));
        $this->loadTranslationsFrom(loadTranslationsPath($moduleName), $moduleName);
    }
}
