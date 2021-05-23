<?php


namespace Src;


use Closure;
use Illuminate\Support\ServiceProvider;

class PressBaseServiceProvider extends ServiceProvider
{
    public function boot(Closure $callback)
    {
        $this->registerResource();
    }

    public function register()
    {

    }

    private function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }



}