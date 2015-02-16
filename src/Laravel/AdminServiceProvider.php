<?php  namespace Freshwork\Admin;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {


    /**
     * Boot the service provider
     */
    public function boot()
    {
        $this->loadViewsFrom(app_path('../resources/views/packages/panel-core'),'panel');

        $this->publishes([
            __DIR__.'/resources' 	=> base_path('public/packages/panel-core'),
            __DIR__.'/views'		=> base_path('resources/views/packages/panel-core')
        ]);
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->call([$this,'loadRoutes']);
    }

    public function loadRoutes(Router $router)
    {
        $router->group(['namespace' => 'Freshwork\Admin\Http\Controllers','prefix' => config('admin.prefix','panel')], function($router)
        {
            require __DIR__.'/routes.php';
        });
    }
}