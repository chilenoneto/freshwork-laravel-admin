<?php  namespace Freshwork\Admin\Tools;

use Freshwork\Admin\Contracts\Auth\AdminUserProvider;
use Freshwork\Admin\Contracts\Auth\CanLoginToPanel;

class InstallManager {


    /**
     * @var DatabaseConfigurator
     */
    private $db;

    /**
     * @var CanLoginToPanel
     */
    private $user;

    /**
     * @param DatabaseConfigurator $db
     * @param CanLoginToPanel $user
     * @internal param Application $console
     */
    function __construct(DatabaseConfigurator $db, AdminUserProvider $user)
    {

        $this->db = $db;
        $this->user = $user;
    }

    public function wasSuccessfullyInstalled()
    {
        return
            $this->isDbConnected() &&
            $this->isDbMigrated() &&
            $this->hasCorrectPermissions();
    }

    public function isDbConnected()
    {
        return !$this->db->is_configuration_needed();
    }

    public function isDbMigrated()
    {
        return $this->db->tables_are_migrated();
    }

    public function hasCorrectPermissions()
    {
        return is_writable(storage_path()) && is_writable(storage_path('app/'));
    }

    public function hasAdminUser()
    {
        if(!$this->isDbConnected())return false;

        if(!$this->isDbMigrated())return false;

        return $this->user->withPanelAccessCount();
    }

    public function markAsInstalled(){
        touch(storage_path('app/installed'));
    }

    public function markAsNotInstalled()
    {
        unlink(storage_path('app/installed'));
    }

    public function installTables()
    {
        \Artisan::call('admin:tables');
        \Artisan::call('migrate');
    }

}