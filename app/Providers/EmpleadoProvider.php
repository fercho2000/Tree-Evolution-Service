<?php
namespace App\Providers;

use App\Model\Empleado; // write model name here
use Illuminate\Support\ServiceProvider;

class EmpleadoProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('Empleado', Empleado::all());
        });
    }
}
