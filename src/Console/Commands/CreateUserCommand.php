<?php namespace Freshwork\Admin\Console\Commands;

use Freshwork\Admin\Contracts\Auth\AdminUserProvider;
use Freshwork\Admin\Contracts\Auth\CanLoginToPanel;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Symfony\Component\Console\Input\InputOption;

class CreateUserCommand extends Command
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'admin:create-user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create the migrations needed by the package';


	/**
	 * The command options
	 * @var array
	 */
	protected function getOptions(){

		return [
			['superuser','su',InputOption::VALUE_REQUIRED,'Defines if the user is superuser',true]
		];
	}

	/**
	 * Execute the console command.
	 *
	 * @param AdminUserProvider $userProvider
	 * @return mixed
	 */
	public function fire(AdminUserProvider $userProvider)
	{
		$result = $userProvider->create([
			'name'								=> $this->ask('Name: '),
			'super_user'						=> (bool)$this->option('superuser'),
			'panel_access'						=> true,
			config('admin.auth.login_field')	=> $this->ask('User "'.config('admin.auth.login_field_name').'"'),
			config('admin.auth.password_field')	=> $this->secret('User "'.config('admin.auth.password_field_name').'"')
		]);

		if($result)
		{
			$this->info('User added!');
		}
	}



	

}
