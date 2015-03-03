<?php  namespace Freshwork\Admin\Http\Controllers;

use Freshwork\Admin\Http\Requests\CreateUserFormRequest;
use Freshwork\Admin\Http\Requests\InstallDBFormRequest;
use Freshwork\Admin\Laravel\EloquentAdminUserProvider;
use Freshwork\Admin\Tools\DatabaseConfigurator;
use Freshwork\Admin\Tools\InstallManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Session\Store;

/**
 * Class InstallerController
 * @package Freshwork\Admin\Http\Controllers
 */
class InstallerController extends BaseController{

    /**
     * @var DatabaseConfigurator
     */
    private $databaseConfigurator;
    /**
     * @var InstallManager
     */
    private $installer;

    /**
     * @param DatabaseConfigurator $databaseConfigurator
     * @param InstallManager $installer
     */
    function __construct(DatabaseConfigurator $databaseConfigurator, InstallManager $installer)
    {
        $this->middleware('admin.is_not_installed');
        $this->databaseConfigurator = $databaseConfigurator;
        $this->installer = $installer;
    }

    /**
     * Show the installer index.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::installer.index',compact('dbStatus','filePermissions'));
    }

    /**
     * Shows the database configuration step
     *
     * @param DatabaseManager $manager
     * @return \Illuminate\View\View
     */
    public function database(DatabaseManager $manager)
    {
        if($this->databaseConfigurator->is_configuration_needed())
        {
            $default_driver = $manager->getDefaultConnection();
            return view('admin::installer.db',compact('default_driver'));
        }
        else
        {
            return redirect()->route('admin.installer.tables');
        }
    }

    /**
     * Saves the database configuration
     *
     * @param InstallDBFormRequest $request
     * @param Store $session
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function install_db(InstallDBFormRequest $request, Store $session)
    {
        $configuration = [
            'driver'    => $request->get('db_driver','mysql'),
            'host'      => $request->get('db_host','localhost'),
            'database'  => $request->get('db_database'),
            'username'  => $request->get('db_username'),
            'password'  => $request->get('db_password'),
            'charset'   => $request->get('db_charset','utf8'),
            'collation' => $request->get('db_collation','utf8_unicode_ci'),
            'prefix'    => $request->get('db_prefix',''),
        ];

        if(!$this->databaseConfigurator->configure_with($configuration))
        {
            $session->flash('message',['status' => 'warning','message' => 'Invalid credentials. I couldn\'t connect to the database.','manual' => true]);
            return redirect()->back()->withInput();
        }

        return redirect()->route('admin.installer.review');
    }

    public function tables()
    {
        if($this->installer->isDbMigrated())
        {
            return redirect()->route('admin.installer.user');
        }

        if(!$this->installer->isDbConnected())
        {
            return redirect()->route('admin.installer.db');
        }


        return view('admin::installer.tables');
    }
    public function install_tables()
    {
        $this->installer->installTables();

        return redirect()->route('admin::installer.user');
    }

    public function user()
    {
        if($this->installer->hasAdminUser())
        {
            return redirect()->route('admin.installer.review');
        }

        if(!$this->installer->isDbMigrated())
        {
            return redirect()->route('admin.installer.tables');
        }

        $login_field = config('admin.auth.login_field');
        $login_field_name = config('admin.auth.login_field_name');
        $password_field = config('admin.auth.password_field');
        $password_field_name = config('admin.auth.password_field_name');

        return view('admin::installer.user',compact('login_field','login_field_name','password_field','password_field_name'));
    }

    public function store_user(EloquentAdminUserProvider $userProvider, CreateUserFormRequest $request)
    {
        $userProvider->create([
            'name'                                  => $request->get('name'),
            'super_user'                            => true,
            'panel_access'                          => true,
            config('admin.auth.login_field')        => $request->get(config('admin.auth.login_field')),
            config('admin.auth.password_field')     => $request->get(config('admin.auth.password_field')),
        ]);

        return redirect()->route('admin.installer.review');
    }

    public function review()
    {
        return view('admin::installer.review');
    }

    public function confirm_review(Store $session)
    {
        if($this->installer->wasSuccessfullyInstalled())
        {
            $this->installer->markAsInstalled();
            return redirect()->route('admin.auth.login');
        }

        $session->flash('message',['status' => 'danger', 'message' => 'Your project was not installed successfully. Try again. ']);
        return redirect()->route('admin.installer.index');
    }




}