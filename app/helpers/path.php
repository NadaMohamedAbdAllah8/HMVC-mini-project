<?php

function getModulePath($moduleName)
{
    return app_path('Modules' . DS() . $moduleName . DS());
}

function DS()
{
    return DIRECTORY_SEPARATOR;
}

function loadRoutePath($moduleName, $fileName)
{
    return getModulePath($moduleName) . 'routes' . DS() . $fileName;
}

function loadViewsPath($moduleName)
{
    return getModulePath($moduleName) . 'resources' . DS() . 'views';
}

function loadMigrationsPath($moduleName)
{
    return getModulePath($moduleName) . 'database' . DS() . 'migrations';
}

function loadTranslationsPath($moduleName)
{
    return getModulePath($moduleName) . 'resources' . DS() . 'lang';
}

function loadConfig($moduleName, $fileName)
{
    return getModulePath($moduleName) . 'config' . DS() . $fileName;
}
