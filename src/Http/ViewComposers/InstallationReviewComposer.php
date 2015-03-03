<?php namespace Freshwork\Admin\Http\ViewComposers;

use Freshwork\Admin\Tools\DatabaseConfigurator;
use Freshwork\Admin\Tools\InstallManager;
use Illuminate\Contracts\View\View;

class InstallationReviewComposer  {

    /**
     * @var InstallManager
     */
    private $install;

    /**
     * @param InstallManager $install
     */
    function __construct(InstallManager $install)
    {
        $this->install = $install;
    }

    public function compose(View $view)
    {
        $view->with('dbStatus',$this->install->isDbConnected());
        $view->with('dbTables',$this->install->isDbMigrated());
        $view->with('filePermissions',$this->install->hasCorrectPermissions());
        $view->with('thereAdmins',$this->install->hasAdminUser());
    }
}