<?php

namespace SierraTecnologia\Facilitador\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use SierraTecnologia\Facilitador\Services\RegisterService;
use SierraTecnologia\Facilitador\Services\RepositoryService;

class FacilitadorRouteProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'SierraTecnologia\Facilitador\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot()
    {
        parent::boot();

        Route::bind('facilitadorService', function ($value) {
            return new RepositoryService($value);
        });

        Route::bind('repositoryService', function ($value) {
            return new RegisterService($value);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        
        $router->group([
            'namespace' => $this->namespace,
        ], function ($router) {
            require __DIR__.'/../Routes/web.php';
        });
    }
}
