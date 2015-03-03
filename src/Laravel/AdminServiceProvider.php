<?php  namespace Freshwork\Admin\Laravel;


use Freshwork\Admin\Auth\BasicAcl;
use Freshwork\Admin\Contracts\Auth\ACL as ACL_Contract;
use Freshwork\Admin\Contracts\Auth\AdminUserProvider;
use Freshwork\Admin\Contracts\Auth\CanLoginToPanel;
use Freshwork\Admin\Models\AdminConfiguration;
use Freshwork\Admin\Models\User;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class AdminServiceProvider
 * @package Freshwork\Admin\Laravel
 */
class AdminServiceProvider extends ServiceProvider {


    /**
     * Boot the service provider
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views','admin');
        $this->loadTranslationsFrom(__DIR__.'/../lang','admin'  );
        //$this->loadViewsFrom(app_path('../resources/views/packages/admin-core'),'admin');
        $this->registerViewComposers();

        $this->publishes([
            __DIR__.'/../resources' 	    => base_path('public/packages/admin-core'),
            __DIR__.'/../views'		        => base_path('resources/views/packages/admin-core'),
            __DIR__.'/../config/config.php' => config_path('admin.php'),
        ]);

    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->call([$this,'loadConfiguration']);
        $this->app->call([$this,'loadRoutes']);
        $this->app->call([$this,'loadMiddlewares']);
        $this->app->call([$this,'loadBinds']);
        $this->app->call([$this,'registerPackages']);
        $this->app->call([$this,'registerFacades']);
        $this->app->call([$this,'registerArtisanCommands']);

    }

    /**
     * Load the base admin routes.
     * @param Router $router
     *
     * @return $this
     */
    public function loadRoutes(Router $router)
    {
        $router->group(['namespace' => 'Freshwork\Admin\Http\Controllers','prefix' => config('admin.prefix','admin')], function($router)
        {
            require __DIR__.'/routes.php';
        });

        return $this;
    }

    /**
     * Load the middlewares provided by the package
     *
     * @param Router $router
     * @return $this
     */
    public function loadMiddlewares(Router $router)
    {
        $router->middleware('admin','Freshwork\Admin\Http\Middleware\SimpleAuthMiddleware');

        $router->middleware('admin.is_not_installed','Freshwork\Admin\Http\Middleware\CheckIfNotInstalled');

        $router->middleware('acl','Freshwork\Admin\Http\Middleware\AclMiddleware');

        return $this;
    }

    /**
     * Load packages configurations files
     *
     * @return $this
     */
    public function loadConfiguration()
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../config/config.php'),'admin');

        return $this;
    }

    /**
     * Bind
     *
     * @return $this
     */
    public function loadBinds()
    {
        $this->app->bind(ACL_Contract::class,BasicAcl::class);
        $this->app->bind(CanLoginToPanel::class,User::class);
        $this->app->bind(AdminUserProvider::class,EloquentAdminUserProvider::class);
        $this->app->bind('admin.configuration',AdminConfiguration::class);

        return $this;
    }

    /**
     * Register third-party packages service providers
     *
     * @return $this
     */
    public function registerPackages()
    {
        $this->app->register('Illuminate\Html\HtmlServiceProvider');

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function registerFacades()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('AdminConfig','Freshwork\Admin\Laravel\Facades\Config');
        $loader->alias('Form','Illuminate\Html\FormFacade');
        $loader->alias('Html','Illuminate\Html\HtmlFacade');

        return $this;
    }

    /**
     * Register the view composers
     *
     * @return $this
     */
    public function registerViewComposers()
    {
        view()->composer('admin::installer.partials.review','Freshwork\Admin\Http\ViewComposers\InstallationReviewComposer');

        return $this;
    }

    public function registerArtisanCommands()
    {
        $this->commands('Freshwork\Admin\Console\Commands\InstallCommand');
        $this->commands('Freshwork\Admin\Console\Commands\TableCommand');
        $this->commands('Freshwork\Admin\Console\Commands\ConfigureDBCommand');
        $this->commands('Freshwork\Admin\Console\Commands\CreateUserCommand');
    }
}