<?php  namespace Freshwork\Admin\Laravel;


use Freshwork\Admin\Auth\BasicAcl;
use Freshwork\Admin\Contracts\Auth\ACL as ACL_Contract;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {


    /**
     * Boot the service provider
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views','panel');
        //$this->loadViewsFrom(app_path('../resources/views/packages/panel-core'),'admin');

        $this->publishes([
            __DIR__.'/../resources' 	=> base_path('public/packages/panel-core'),
            __DIR__.'/../views'		    => base_path('resources/views/packages/panel-core')
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

        $this->app->bind(ACL_Contract::class,BasicAcl::class);
    }

    public function loadRoutes(Router $router)
    {
        $router->middleware('admin','Freshwork\Admin\Http\Middleware\SimpleAuthMiddleware');

        $router->middleware('acl','Freshwork\Admin\Http\Middleware\AclMiddleware');

        $router->middleware('acl','Freshwork\Admin\Http\Middleware\CheckForInstalledPanel');

        $router->group(['namespace' => 'Freshwork\Admin\Http\Controllers','prefix' => config('admin.prefix','admin')], function($router)
        {
            require __DIR__.'/routes.php';
        });
    }
}