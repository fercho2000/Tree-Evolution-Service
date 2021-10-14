<?php
namespace App\Providers;

use App\Model\Implemento; // write model name here
use Illuminate\Support\ServiceProvider;

class ImplementoProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('Implemento', Implemento::all());
        });
    }
}
