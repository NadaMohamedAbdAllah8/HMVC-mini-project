<?php
function buildPrefix($moduleName)
{
    return config($moduleName . 'Route.prefix',
        config('mouduleRoutes.' . $moduleName . 'DefaultPrefix'));
}

function buildNamespace($moduleName)
{
    return ucfirst($moduleName) . '\Http\Controllers';
}
