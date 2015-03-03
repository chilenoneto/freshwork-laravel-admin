<?php  namespace Freshwork\Admin\Tools;

use Illuminate\Config\Repository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Queue\Capsule\Manager;

class DatabaseConfigurator {

    /**
     * @var EnvironmentConfigurator
     */
    private $environmentConfigurator;
    /**
     * @var DatabaseManager
     */
    private $dbmanager;
    /**
     * @var Repository
     */
    private $config;

    function __construct(EnvironmentConfigurator $environmentConfigurator, DatabaseManager $dbmanager, Repository $config)
    {
        $this->environmentConfigurator = $environmentConfigurator;
        $this->dbmanager = $dbmanager;
        $this->config = $config;
    }

    public function is_configuration_needed()
    {
        try{
            $this->dbmanager->connection();
        }catch(\PDOException $e){
            return true;
        }
        return false;
    }

    public function configure_with(array $configuration){
        if($this->testConnection($configuration))
        {
            $this->environmentConfigurator
                ->setEnvironmentFile(base_path().'/'.app()->environmentFile())
                ->configure([
                    'DB_HOST'       => $configuration['host'],
                    'DB_DATABASE'   => $configuration['database'],
                    'DB_USERNAME'   => $configuration['username'],
                    'DB_PASSWORD'   => $configuration['password']
                ]);

            return true;
        }
        return false;
    }
    public function testConnection($configuration)
    {
        $this->config->set('database.connections.admin_test',[
            'driver'    => array_get($configuration,'driver','mysql'),
            'host'      => array_get($configuration,'host','localhost'),
            'database'  => array_get($configuration,'database',''),
            'username'  => array_get($configuration,'username',''),
            'password'  => array_get($configuration,'password',''),
            'charset'   => array_get($configuration,'charset','utf8'),
            'collation' => array_get($configuration,'collation','utf8_unicode_ci'),
            'prefix'    => array_get($configuration,'prefix',''),
        ]);

        try{
            ($this->dbmanager->connection('admin_test')->getDatabaseName());
        }catch (\PDOException $e){
            return false;
        }

        return true;
    }

    public function tables_are_migrated()
    {
        $tables = $this->getPanelBaseTables();
        try{
            $this->dbmanager->table(config('admin.auth.table'))->count();
            $this->dbmanager->table(config('admin.config.table'))->count();
        }catch(\Exception $e){
            return false;
        }

        return true;
    }

    private function getPanelBaseTables()
    {

    }
}