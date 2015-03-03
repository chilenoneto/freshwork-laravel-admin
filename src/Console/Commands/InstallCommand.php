<?php namespace Freshwork\Admin\Console\Commands;

use Freshwork\Admin\Tools\InstallManager;
use Illuminate\Console\Command;

class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install and configure the package';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire(InstallManager $manager)
	{
		if(!$manager->isDbConnected()){
			$this->call('admin:configure-db');
		}

		if(!$manager->isDbMigrated()){
			$this->call('admin:tables');
			$this->call('migrate');
		}

		if(!$manager->hasAdminUser()){
			$this->call('admin:create-user');
		}

		$this->info('Panel installed!');
	}



}
