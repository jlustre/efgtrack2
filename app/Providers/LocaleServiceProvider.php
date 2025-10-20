<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LocaleServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(Router $router)
    {
        // Alias middleware so we can use it in route groups if needed
        $router->aliasMiddleware('setlocale', \App\Http\Middleware\SetLocale::class);
    }
}
