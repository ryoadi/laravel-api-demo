<?php

$telescope = app()->isLocal() ?
    [
        \Laravel\Telescope\TelescopeServiceProvider::class,
        \App\Providers\TelescopeServiceProvider::class,
    ] : [];

return [
    App\Providers\AppServiceProvider::class,
    ...$telescope,
];
