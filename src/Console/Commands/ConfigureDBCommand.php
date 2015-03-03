<?php namespace Freshwork\Admin\Console\Commands;

use Freshwork\Admin\Tools\DatabaseConfigurator;
use Freshwork\Admin\Tools\InstallManager;
use Illuminate\Console\Command;

class ConfigureDBCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:configure-db';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Set your database enviroment variables';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire(DatabaseConfigurator $databaseConfigurator, InstallManager $manager)
	{
		$this->info('Configuring DB...');
		$configuration = config('database.connections.'.config('database.default'));

		if($manager->isDbConnected())
		{
			if(!$this->confirm('Your database is already connected. Do you want to configure it anyway? [y/N]')){
				return;
			}
		}

		$configuration = array_merge([
            'host'      => $this->ask('Database host: ','localhost'),
            'database'  => $this->ask('Database name: ','homestead'),
            'username'  => $this->ask('Database user: ','homestead'),
            'password'  => $this->secret('Database password: '),
        ],$configuration);

		if($databaseConfigurator->configure_with($configuration))
		{
			$this->info('Database configured!');
		}
		else
		{
			if($this->confirm('<error>Could not connect to Database with this credentials.</error> Try again? [y/N]',true))
			{
				$this->call('admin:configure-db');
			}
		}

	}



}
