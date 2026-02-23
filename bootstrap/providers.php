<?php

$telescope = env('APP_ENV') === 'local' ?
    [
        \Laravel\Telescope\TelescopeServiceProvider::class,
        \App\Providers\TelescopeServiceProvider::class,
    ] : [];

return [
    App\Providers\AppServiceProvider::class,
    ...$telescope,
];
