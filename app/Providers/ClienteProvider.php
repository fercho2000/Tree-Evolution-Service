<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Cliente;

class ClienteProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('Cliente', Cliente::all());
        });
    }
}
