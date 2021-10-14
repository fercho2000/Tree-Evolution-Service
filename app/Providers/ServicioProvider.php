<?php
namespace App\Providers;

use App\Model\Servicio; // write model name here
use Illuminate\Support\ServiceProvider;

class ServicioProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('Servicio', Servicio::all());
        });
    }
}
