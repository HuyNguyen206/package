<?php


namespace huynl\Press;


use huynl\Press\Console\Commands\ProcessCommand;
use huynl\Press\Fields\Body;
use huynl\Press\Fields\Date;
use huynl\Press\Fields\Description;
use huynl\Press\Fields\Extra;
use huynl\Press\Fields\Title;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use huynl\Press\Facades\Press;


class PressBaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ProcessCommand::class,
            ]);
        }
        $this->registerPublishing();
        $this->registerResource();
    }


    public function register()
    {
    }

    private function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'press');
        $this->registerFacade();
        $this->registerRoutes();
        $this->registerFields();
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/press.php' => config_path('press.php')
        ], 'press-config');

        $this->publishes([
            __DIR__ . '/../src/Console/stubs/PressServiceProvider.stub' => app_path('Providers/PressServiceProvider.php')
        ], 'press-provider');
    }

    protected function registerRoutes()
    {
        Route::group($this->loadConfigRoute(), function(){
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function loadConfigRoute()
    {
        return [
            'prefix' => Press::prefixPath(),
            'namespace' => "huynl\\Press\\Http\\Controllers"
        ];
    }

    protected function registerFacade(){
        $this->app->singleton('Press', function($app){
            return new \huynl\Press\Press();
        });
    }

    private function registerFields()
    {
        Press::fields([
            Body::class,
            Date::class,
            Description::class,
            Extra::class,
            Title::class
            ]);
    }


}