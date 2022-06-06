<?php
function buildPrefix($moduleName)
{
    return config($moduleName . 'Route.prefix',
        config('mouduleRoutes.' . $moduleName . 'DefaultPrefix'));
}
