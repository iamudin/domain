<?php
namespace Leazycms\Domain;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Leazycms\Domain\Middleware\DomainMiddleware;

class DomainServiceProvider extends ServiceProvider
{
    protected function registerRoutes()
    {
        Route::middleware(['web','admin.domain'])
        ->prefix(admin_path())
        ->group(function () {
            $this->loadRoutesFrom(__DIR__.'/routes/admin.php');
        });

        Route::middleware(['web'])
        ->prefix('domain')
        ->group(function () {
            $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        });
    }
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'domain');
    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");
    }


    public function boot(Router $router)
    {
        $router->aliasMiddleware('admin.domain', DomainMiddleware::class);
        $this->registerResources();
        $this->registerMigrations();
        $this->add_extension();
        $this->registerRoutes();
    }
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/config/config.php", "domain");
    }
    function add_extension()
    {
        if (!collect(config('modules.extension_module'))->where('path','domain')->count()) {
            add_extension(config('domain'));
        }
    }
}
